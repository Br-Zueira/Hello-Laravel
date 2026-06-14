FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev nodejs npm \
    && docker-php-ext-install zip pcntl \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm ci && npm run build

CMD touch /var/www/html/database/database.sqlite && \
    php artisan migrate --seed --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan serve --host=0.0.0.0 --port=$PORT