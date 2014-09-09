# Sistema de Repositorio de Vancantes para Universidad (Bolsa de Trabajo)

* Sistema diseñado para la creación vacantes de empresas y visualización de estadísticas de las vacantes comsumido a través de la web.

* Las empresas tienen control de sus vacantes y pueden descargar los currículums de los aplicantes a sus vacantes.

* Las vacantes nuevas se notifican a través de correo a los aplicantes (por carrera) registrados en el sistema.

* Las estadísticas se generan mensualmente (por carrera y generales)

* El administrador General tiene que dar de alta a las empresas para participar.

* Casos de uso del sistema [link](./_casos.md)

* Diagrama de las BD del sistema [link](./_base_de_datos.md)

* Detalles Técnicos del sistema. [link](./_info.md)

## Configuración Inicial (production)

* **versión PHP mínima**: `5.4`

* clonar el repositorio

* instalar **composer** [+info](https://getcomposer.org/doc/00-intro.md#installation-nix) 

* donde se encuentra el archivo `composer.json` ejecutar `$ composer install --prefer-dist --no-dev`

* crear una cuenta [mandrill](https://mandrillapp.com/), para el envió de correos del sistema, obtener una **API KEY** y llenar las credenciales necesarias en el archivo `.env.php`

* modificar el archivo `app/config/mail.php` con las variables de entorno definidas en `.env.php`

* para dar de alta un cronjob `$ sudo crontab -e` y agregar `* * * * * php /path/to/artisan scheduled:run 1>> /dev/null 2>&1` [+ info](https://github.com/Indatus/dispatcher)


## Configuración para Producción (Manual, opcional)

* ejecutar `$ php artisan key:generate`, para generar la **cadena** base que se usará como semilla para el *hashing* de datos (sólo se debe ejecutar **una** vez en toda la historia del sistema).

* ejecutar `$ php artisan bolsa:setup`.

* seedear los catálogos `php artisan db:seed --env=bolsa --database=sqlite`.

* crear una cuenta [mandrill](https://mandrillapp.com/) para el envió de correos en el sistema, obtener una **API KEY** y llenar las credenciales en el archivo `.env.php`

* modificar el archivo `app/config/mail.php` con las variables de entorno definidas en `.env.php`

* `sudo crontab -e` agregar el cronjob `* * * * * php /path/to/artisan scheduled:run 1>> /dev/null 2>&1` [+ info](https://github.com/Indatus/dispatcher)

* agregar al archivo `.env.php` los siguientes los campos vacios *(USERNAME Y API KEY)*:

```
<?php
return array(
    'SMTP' => 'smtp.mandrillapp.com',
    'SMTP_USER' => "",
    "MANDRILL_KEY" => ""
);
```

* Ir a la página index del sistema.

* Iniciar sesión `user: admin@bolsa.com, pass: bolsa` para generar un Administrador General.

## helpers

* para configurar el *environment* del sistema modificar el archivo `bootstrap/start.php`, *DEFAULT:* production
    * más [info](http://laravel.com/docs/    configuration#environment-configuration) 
    
* `$ php artisan bolsa:setup` hace lo siguiente:* 
    * Establace una clave para numerar las vacantes `$ php artisan tiny:generate`
    * Crea bases de datos (sqlite) `production.sqlite y reportes.sqlite` en `app/database/`
    * Migra las bases de datos `reportes y production`

* borrar migraciones de **reportes** `php artisan migrate:reset --database="reportes"`

* para visualizar los commandos (cronjobs) del sistema `php artisan scheduled:summary`

* para configurar el número mínimo de vacantes por carrera para notificar por mail `app/config/bolsa.php`, *DEFAULT:* 4

* para configurar el *default subject* de los correos enviados por el sistema `app/config/mail.php`, *DEFAULT:* Bolsa de Trabajo

## Setup para desarrollo

* instalar dependencias sin ejecutar scripts
    * `$ composer install --no-scripts --prefer-dist --dev`
    * `$ composer du -o`

* establacer como **local** el *environment* del sistema.
    * modificar el archivo `bootstrap/start.php` para establacer **local** como *environment*
    * para ver el estado actual del *environment* `$ php artisan env` => local

* ejecutar `$ php artisan bolsa:setup`

* modificar el archivo `app/config/local/mail.php` con las variables de entorno definidas en `.env.local.php`

* seedear la base de datos `$ php artisan db:seed`

* `php artisan serve`