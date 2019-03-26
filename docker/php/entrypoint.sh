#!/bin/sh

php bin/console d:d:c
php bin/console d:m:m -q
chmod -R 777 var/
php-fpm -F
