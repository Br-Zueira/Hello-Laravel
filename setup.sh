#!/usr/bin/env bash
# Safety guard to quit execution at first command error
set -e

# Dependencies
apt update && \
apt install -y php php-sqlite3 php-xml php-mbstring composer nodejs && \
composer install --no-dev --optimize-autoloader && \
npm ci && npm run build && \

# .env File
([ ! -f .env ] && cp .env.example .env && php artisan key:generate || true) && \

# Database
mkdir -p database && \
chmod 775 database && \
touch database/database.sqlite && \
chmod 775 database/database.sqlite && \

# Migrations & optimizations
php artisan migrate --seed --force && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \

# Serving web page
php -d variables_order=EGPCS artisan serve --host=0.0.0.0 --port=$PORT 2>&1