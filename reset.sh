#!/usr/bin/env bash

# install dependencies
composer install --prefer-dist || exit 1

# clear
php artisan config:clear || exit 1
php artisan route:clear || exit 1
php artisan view:clear || exit 1
php artisan cache:clear || exit 1

#Start redis
sudo systemctl restart redis

# provision
php artisan app:reset $1 $2 || exit 1
php artisan migrate:refresh

#install laravel passport
php artisan passport:install --force

#Seed master data
php artisan db:seed --class=MasterDataSeeder

#Create debug user
php artisan app:create-user --id=1 --name=Zombie_Debug
