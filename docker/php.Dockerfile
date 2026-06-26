FROM php:8.3-fpm-alpine
RUN apk add --no-cache \
    libpng-dev libjpeg-turbo-dev freetype-dev zip libzip-dev oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
