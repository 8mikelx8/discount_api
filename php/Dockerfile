FROM php:fpm-alpine
# RUN docker-php-ext-install opcache
# COPY php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
