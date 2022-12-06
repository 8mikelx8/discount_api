#!/bin/sh

docker-compose build --no-cache
docker-compose up -d
docker exec discount_api_php sh -c "curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer"
docker exec discount_api_php composer install