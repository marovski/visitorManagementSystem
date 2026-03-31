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

# Wait for DB and run migrations
until php artisan migrate --force 2>&1; do
    echo "DB not ready, retrying in 3s..."
    sleep 3
done

exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
