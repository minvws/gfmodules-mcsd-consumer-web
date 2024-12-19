#!/bin/bash

set -e

make setup

npm install && npm run build

rm -rf ~/.symfony5
composer install
symfony server:start