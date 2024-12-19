#!/bin/bash

set -e

make setup-config
make setup-php

rm -rf ~/.symfony5
composer install
symfony server:start