#!/usr/bin/env bash
set -e

PORT="${PORT:-10000}"

# Render injects the web port through PORT, so Apache must listen on it.
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

php -r '
$dsn = "mysql:host=".getenv("DB_HOST").";port=".getenv("DB_PORT").";dbname=".getenv("DB_DATABASE").";charset=utf8mb4";
try {
    $opts = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        (PHP_VERSION_ID >= 80500 ? Pdo\Mysql::ATTR_SSL_CA : PDO::MYSQL_ATTR_SSL_CA) => getenv("MYSQL_ATTR_SSL_CA"),
        (PHP_VERSION_ID >= 80500 ? Pdo\Mysql::ATTR_SSL_VERIFY_SERVER_CERT : PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT) => false,
    ];
    new PDO($dsn, getenv("DB_USERNAME"), getenv("DB_PASSWORD"), $opts);
    echo "PDO SSL OK\n";
} catch (Throwable $e) {
    echo "PDO SSL FAIL: ".$e->getMessage()."\n";
    exit(1);
}'
apache2-foreground
