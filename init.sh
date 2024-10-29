#!/bin/sh
echo "Acquaapiweb initializing..."
service mariadb start
mysql -u root -e "CREATE DATABASE acqua CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"; 
mysqladmin -u root -h localhost password "4XWd4PreCSAjXnyEnbjj0i9lDyqGfhs0"
service mariadb restart
cd /app/
cp conf/lrv.env /app/.env
cd /app/CivisLibertatem
composer install
php artisan key:generate
chgrp -R www-data /app/
chmod -R g+w /app/
php artisan storage:link
php artisan migrate
php artisan key:generate
php artisan db:seed 
php artisan db:seed --class=UserSeeder
