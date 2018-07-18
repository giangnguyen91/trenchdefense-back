#!/usr/bin/env bash

# cd to script path
cd "$(dirname "$0")"

exit_finally() {
    # return to original path
    cd --
}

trap exit_finally EXIT

# install dependencies
composer install || exit 1

# clear
php artisan config:clear || exit 1
php artisan route:clear || exit 1
php artisan view:clear || exit 1
php artisan cache:clear || exit 1

# provision
php artisan app:reset $1 $2 || exit 1
php artisan migrate:refresh

#install laravel passport
php artisan passport:install --force
