#!/bin/sh
set -e

# Parse MYSQL_URL into individual DB_* vars if provided
# Format: mysql://user:password@host:port/database
if [ -n "$MYSQL_URL" ]; then
    export DB_HOST=$(php -r "echo parse_url('$MYSQL_URL', PHP_URL_HOST);")
    export DB_PORT=$(php -r "echo parse_url('$MYSQL_URL', PHP_URL_PORT) ?: 3306;")
    export DB_DATABASE=$(php -r "echo ltrim(parse_url('$MYSQL_URL', PHP_URL_PATH), '/');")
    export DB_USERNAME=$(php -r "echo parse_url('$MYSQL_URL', PHP_URL_USER);")
    export DB_PASSWORD=$(php -r "echo parse_url('$MYSQL_URL', PHP_URL_PASS);")
    echo "DB config parsed from MYSQL_URL: host=$DB_HOST port=$DB_PORT db=$DB_DATABASE"
fi

# Wait for DB using PDO
until php -r "
try {
    new PDO('mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD');
    echo 'ok';
} catch(Exception \$e) {
    exit(1);
}" 2>/dev/null | grep -q ok; do
    echo "Waiting for DB..."
    sleep 2
done

echo "DB is ready. Dropping all tables for clean migration..."

# Drop all existing tables (handles partial state from previous crash-loops)
php -r "
\$pdo = new PDO('mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD');
\$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
\$tables = \$pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
foreach(\$tables as \$table) {
    \$pdo->exec('DROP TABLE IF EXISTS \`' . \$table . '\`');
    echo 'Dropped: ' . \$table . PHP_EOL;
}
\$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
echo 'Done.' . PHP_EOL;
"

# Fall back to log driver so password-reset emails don't crash when SMTP
# env vars haven't been configured yet. Set MAIL_DRIVER in Railway env vars
# to override (e.g. MAIL_DRIVER=smtp with full MAIL_HOST/PORT/USERNAME/PASSWORD).
export MAIL_DRIVER=${MAIL_DRIVER:-log}

# APP_KEY is required for cookie encryption. If not set as a Railway env var,
# generate a temporary one. NOTE: each restart will generate a new key and
# invalidate all sessions. Set APP_KEY permanently in Railway env vars:
#   php artisan key:generate --show   → copy the output to Railway > Variables
if [ -z "$APP_KEY" ]; then
    export APP_KEY="base64:$(php -r 'echo base64_encode(random_bytes(32));')"
    echo "WARNING: APP_KEY not set — generated a temporary key. Sessions will"
    echo "         reset on every container restart. Set APP_KEY in Railway vars."
fi

# Enable debug mode so real errors show instead of generic "Whoops" page.
# Set APP_DEBUG=false in Railway env vars once the app is stable.
export APP_DEBUG=${APP_DEBUG:-true}
export APP_ENV=${APP_ENV:-production}

# Ensure required storage subdirectories exist and are writable
mkdir -p storage/framework/sessions \
         storage/framework/views \
         storage/framework/cache \
         storage/logs
chown -R www-data:www-data storage
chmod -R 775 storage

echo "Clearing application caches..."
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear

echo "Running migrations..."
php artisan migrate --force

echo "Seeding admin user..."
php artisan db:seed --force

# Configure Apache to listen on the PORT Railway assigns (default 8080)
PORT=${PORT:-8080}
echo "Listen $PORT" > /etc/apache2/ports.conf
sed -i "s|<VirtualHost \*:80>|<VirtualHost *:$PORT>|g" /etc/apache2/sites-available/000-default.conf

# Ensure only mpm_prefork is loaded (mod_php is incompatible with event/worker)
rm -f /etc/apache2/mods-enabled/mpm_event.load \
       /etc/apache2/mods-enabled/mpm_event.conf \
       /etc/apache2/mods-enabled/mpm_worker.load \
       /etc/apache2/mods-enabled/mpm_worker.conf
[ ! -f /etc/apache2/mods-enabled/mpm_prefork.load ] && a2enmod mpm_prefork

echo "Starting Apache on port $PORT..."
exec apache2-foreground
