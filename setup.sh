#!/usr/bin/env bash
# Safety guard to quit execution at first command error
set -euo pipefail

# Sets URL and PORT
URL="$1"
PORT="${2:-8000}"
HOST="${3:-0.0.0.0}"

if [ -z "$URL" ]; then
    echo "Error: Missing required URL parameter."
    echo "Usage: $0 <URL> [PORT] [HOST]"
    exit 1
fi

# Dependencies
apt update && \
apt install -y php php-sqlite3 php-xml php-mbstring composer nodejs npm && \
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader && \
npm ci && npm run build && \

# .env File
([ ! -f .env ] &&  cp .env.example .env && php artisan key:generate && sed -i "|s|APP_URL=.*|APP_URL=$URL|g" .env || true) && \

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
php -d variables_order=EGPCS artisan serve --host="$HOST" --port="$PORT" 2>&1