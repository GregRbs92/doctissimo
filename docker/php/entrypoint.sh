#!/bin/sh

php bin/console d:d:c
php bin/console d:m:m -q
php-fpm -F
