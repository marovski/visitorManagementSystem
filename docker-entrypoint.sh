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
