curl -sS https://getcomposer.org/installer | /opt/lampp/bin/php
/opt/lampp/bin/php composer.phar dump-autoload --optimize
/opt/lampp/bin/php artisan key:generate",
/opt/lampp/bin/php artisan bolsa:setup",
/opt/lampp/bin/php artisan db:seed --env=bolsa --database=sqlite",
sudo chmod -R 777 app/storage",
sudo chmod 777 app/database/production.sqlite",
sudo chmod 777 app/database/reportes.sqlite",
/opt/lampp/bin/php composer.phar dump-autoload --optimize",
/opt/lampp/bin/php artisan optimize",
sudo chown www-data app/database/production.sqlite",
sudo chown www-data app/database/reportes.sqlite"