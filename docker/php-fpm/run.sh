#!/bin/sh

cd /var/www/html/test || exit
echo '[+] Composer install'
composer install

echo '[+] Migrations'
php bin/console doctrine:migrations:migrate

echo '[+] Start php-fpm'
exec "php-fpm"
