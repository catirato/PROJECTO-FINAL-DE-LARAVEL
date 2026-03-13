#!/bin/sh
set -e

mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/testing
mkdir -p storage/framework/views
mkdir -p bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

if [ "${DB_CONNECTION}" = "mysql" ]; then
    echo "Waiting for MySQL..."
    until php -r '
        try {
            new PDO(
                "mysql:host=".getenv("DB_HOST").";port=".getenv("DB_PORT").";dbname=".getenv("DB_DATABASE"),
                getenv("DB_USERNAME"),
                getenv("DB_PASSWORD"),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            exit(0);
        } catch (Throwable $e) {
            fwrite(STDERR, $e->getMessage().PHP_EOL);
            exit(1);
        }
    '; do
        sleep 2
    done
fi

php artisan storage:link --force || true
php artisan migrate --force

if [ "${RUN_DB_SEED:-false}" = "true" ]; then
    php artisan db:seed --force
fi

exec php-fpm
