# === STAGE 1: Frontend Asset Compilation ===
FROM node:20-alpine AS frontend-builder
WORKDIR /app
COPY package*.json vite.config.js ./
# Copy resources folder where Laravel CSS/JS files live
COPY resources/ ./resources/
RUN npm install && npm run build

# === STAGE 2: Production PHP Runtime ===
FROM php:8.3-fpm-alpine

# Install essential system extensions for Laravel
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd

# Bring in the official Composer binary
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy all application source code
COPY . /var/www

# Pull compiled CSS/JS from Stage 1 into the production public folder
COPY --from=frontend-builder /app/public/build /var/www/public/build

# Run strict production optimization
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Give PHP permissions to handle uploads, session logs, and cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Cache Laravel core configurations for fast performance
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

EXPOSE 9000

# Run migrations automatically, then start the PHP processor
CMD php artisan migrate --force && php-fpm
