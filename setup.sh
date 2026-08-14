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
echo "Downloading dependencies" && \
apt update && \
apt install -y php php-sqlite3 php-xml php-mbstring composer nodejs npm sqlite3 && \
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader && \
npm ci && npm run build && \

# .env File
([ ! -f .env ] && echo ".env not found, creating new" && cp .env.example .env && php artisan key:generate && sed -i "|s|APP_URL=.*|APP_URL=$URL|g" .env || true) && \

# Database
echo "Creating fresh database, if none" && \
mkdir -p database && \
chmod 775 database && \
touch database/database.sqlite && \
chmod 775 database/database.sqlite && \

# Migrations & optimizations
php artisan migrate --seed --force && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \

# Serving web page (initing it as a daemon)
# Replacing some data
echo "Replacing laravel.service data" && \
sed -i "s|WorkingDirectory=.*|WorkingDirectory=$(pwd)|g" laravel.service
sed -i "s|ExecStart=.*|ExecStart=/usr/bin/env php -d variables_order=EGPCS $(pwd)/artisan serve --host=$HOST --port=$PORT|g" laravel.service

# Initing the actual daemon
echo "Copying laravel.service to system folder" && \
cp laravel.service /etc/systemd/system/laravel.service && \

echo "Initing daemon" && \
systemctl daemon-reload && \
systemctl enable laravel && \
systemctl restart laravel && \