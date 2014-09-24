# install stuff
composer install --no-scripts --prefer-dist --dev
# optimize
composer du -o
# switch environment
sed -ie 's/return "production";/return "local";/g' bootstrap/start.php
# bolsa setup
php artisan bolsa:setup
# mail dev
sed -ie "s#'pretend'    => false#'pretend'    => true#g" app/config/local/mail.php
# seed app
php artisan db:seed
# serve
php artisan serve &
# show processes
echo "================TO KILL=========="
ps aux | grep "php"
echo "================================="
# show server log
php artisan tail
