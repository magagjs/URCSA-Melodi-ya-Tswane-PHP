#!/bin/sh
echo "Copying 'mytProperties.config' directory into /var/www/config"
yes | cp -rf -v /home/sifisom/data/mytchurch.co.za/mytConfig/mytProperties.config /var/www/config/

echo
echo "Copying 'mytComponents.php' directory into /var/www/config"
yes | cp -rf -v /home/sifisom/data/mytchurch.co.za/mytConfig/mytComponents.php /var/www/config/

echo
echo "Copying 'mytUploadImg.php' directory into /var/www/config"
yes | cp -rf -v /home/sifisom/data/mytchurch.co.za/mytConfig/mytUploadImg.php /var/www/config/

echo
echo "Copying 'api' directory into '/var/www/html/mytchurch.co.za/api'"
yes | cp -rf -v /home/sifisom/data/mytchurch.co.za/api/* /var/www/html/mytchurch.co.za/api

echo
echo "Copying 'assets' directory into '/var/www/html/mytchurch.co.za/assets'"
yes | cp -rf -v /home/sifisom/data/mytchurch.co.za/assets/* /var/www/html/mytchurch.co.za/assets

echo
echo "Copying 'css' directory into '/var/www/html/mytchurch.co.za/css'"
yes | cp -rf -v /home/sifisom/data/mytchurch.co.za/css/* /var/www/html/mytchurch.co.za/css

echo
echo "Copying 'scripts' directory into '/var/www/html/mytchurch.co.za/scripts'"
yes | cp -rf -v /home/sifisom/data/mytchurch.co.za/scripts/* /var/www/html/mytchurch.co.za/scripts

echo
echo "Copying 'js' directory into '/var/www/html/mytchurch.co.za/js'"
yes | cp -rf -v /home/sifisom/data/mytchurch.co.za/js/* /var/www/html/mytchurch.co.za/js

echo
echo "Copying 'inc' directory into '/var/www/html/mytchurch.co.za/inc'"
yes | cp -rf -v /home/sifisom/data/mytchurch.co.za/inc/* /var/www/html/mytchurch.co.za/inc

echo
echo "Copying all files in 'mytchurch.co.za' directory into '/var/www/html/mytchurch.co.za'"
yes | cp -f -v /home/sifisom/data/mytchurch.co.za/* /var/www/html/mytchurch.co.za

