FROM php:8.2-fpm-alpine
RUN apk add --no-cache \
    libpng-dev libjpeg-turbo-dev freetype-dev zip libzip-dev oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd
WORKDIR /var/www
