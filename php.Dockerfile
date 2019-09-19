FROM php:7.3.2-fpm-alpine

# composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
