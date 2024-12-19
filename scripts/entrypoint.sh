#!/bin/bash

set -e

make setup

npm install && npm run build
composer install

php artisan serve --port=8510