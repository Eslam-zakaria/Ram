#!/bin/bash

cd /root/ram-main-website
echo "Deploy"
ls
git pull --rebase
docker-compose exec -T app composer install
# docker-compose exec app php artisan db:wipe
# docker-compose exec app php artisan migrate:refresh --seed
docker-compose exec -T app php  artisan migrate
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php  artisan cache:clear
docker-compose exec -T app php  artisan view:clear
docker-compose exec -T app php  artisan config:clear
