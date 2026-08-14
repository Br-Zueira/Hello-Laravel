#!/usr/bin/env bash
# Safety guard to quit execution at first command error
set -e

# Dependencies
sudo apt update && \
sudo apt install -y php php-sqlite3 php-xml php-mbstring composer nodejs sqlite3 && \
composer install && \
npm install && \

# .env File
([ ! -f .env ] && cp .env.example .env && php artisan key:generate || true) && \

# Database
mkdir -p database && \
chmod 775 database && \
touch database/database.sqlite && \
chmod 775 database/database.sqlite && \

# Migrations & optimizations
php artisan migrate --seed --force && \