#!/usr/bin/env bash
set -e

php artisan config:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

ls -l /etc/secrets && php -r "var_dump(file_exists('/etc/secrets/ca.pem'));"

apache2-foreground
