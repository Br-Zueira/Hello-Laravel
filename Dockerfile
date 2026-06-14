FROM dunglas/frankenphp:1-php8.4

# Install system dependencies & Node.js for building assets
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev nodejs npm \
    && docker-php-ext-install zip pcntl \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy code into the container
COPY . .

# Install dependencies and build front-end
RUN composer install --no-dev --optimize-autoloader
RUN npm ci && npm run build

EXPOSE 8080

# Boot: create sqlite, migrate, cache config, start Octane
CMD touch /var/www/html/database/database.sqlite && \
    php artisan migrate --seed --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php -d variables_order=EGPCS artisan octane:start --server=frankenphp --host=0.0.0.0 --port=$PORT