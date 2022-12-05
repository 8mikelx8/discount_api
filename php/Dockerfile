FROM php:fpm-alpine
RUN docker-php-ext-install opcache
COPY php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./code/ /var/www/html/
COPY composer.json composer.lock ./
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer install