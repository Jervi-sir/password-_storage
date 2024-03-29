#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html
npm install

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
#php artisan migrate --force

npm install --save-dev vite laravel-vite-plugin
npm install --save-dev @vitejs/plugin-vue
npm run build