#!/bin/bash

set -e

scripts/setup-config.sh
scripts/setup-npm.sh
scripts/setup-php.sh
npm run build
php artisan serve --host 0.0.0.0 --port=8510