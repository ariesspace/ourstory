FROM php:8.3-fpm-alpine

RUN apk add --no-cache sqlite-dev oniguruma-dev \
    && docker-php-ext-install pdo_sqlite mbstring

WORKDIR /var/www/html

RUN mkdir -p /var/www/html/storage/data \
    && chown -R www-data:www-data /var/www/html/storage
