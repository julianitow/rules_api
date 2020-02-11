#!/bin/bash

echo "INITIALIZING DATABSE..."
service mysql start
echo "DONE!"
echo "IMPORTING DATABASE SETTINGS..."
mysql -uroot -proot < /var/www/db.sql
echo "DONE!"
echo "MIGRATING DB..."
cd /var/www
php artisan migrate
echo "DONE!"
echo "STARTING API..."
php -S 0.0.0.0:8080 -t /var/www/public