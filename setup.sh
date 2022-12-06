#!/bin/sh
echo "building docker"
docker-compose build --no-cache
docker-compose up -d
echo "installing PHP docker dependencies"
docker exec discount_api_php sh -c "curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer"
docker exec discount_api_php composer install
echo "copying sql files into mysql docker"
docker cp mysql/discount_api.sql discount_api_mysql:/discount_api.sql
docker cp mysql/sql-setup.txt discount_api_mysql:/sql-setup.txt
echo "waiting for mysql server to be up and running"
sleep 120
echo "setting up database"
docker exec discount_api_mysql sh -c "mysql -pMYSQL_ROOT_PASSWORD < sql-setup.txt > output.txt"