#!/bin/sh

php artisan key:generate --force

echo "Menunggu database..."
sleep 5

php artisan migrate --force

php artisan storage:link --force 2>/dev/null || true

php artisan config:clear
php artisan cache:clear

php-fpm &

nginx -g "daemon off;"