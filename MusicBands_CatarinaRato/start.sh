#!/usr/bin/env bash
set -e

php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

apache2-foreground
