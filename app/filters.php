<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request)
{
    if(app('config')['zackkitzmiller/tiny::key'] === "Generar : \$php artisan tiny:generate")
    {
        return "Necesitas generar una clave para generar los ID's de las vacantes: \"\$php artisan tiny:generate\"";
    }

    try
    {
        /** @var $adminGeneral User */
        $adminGeneral = User::where("tipo_usuario", TipoUsuarioModel::ADMIN_GENERAL)->firstOrFail();

        if ($adminGeneral->exists())
        {
            // establacemos el correo del "admin general" como el correo global que
            // se usará para enviar los correos del sistema
            Config::set("mail.from.address", $adminGeneral->present()->correo);

            if(App::environment() === "local")
            {
                Log::alert("email: " . Config::get("mail.from.address"));
                Log::alert("nombre: " . Config::get("mail.from.name"));
            }
        }
    }
    catch (Illuminate\Database\Eloquent\ModelNotFoundException $e)
    {
        Session::put("admin", "Inicia sesión como correo: admin@bolsa.com, contraseña: bolsa");
        Log::alert("///////////////////");
        Log::alert("//APP MAILL CONFIG//");
        Log::alert("///////////////////");
        Log::alert("No existe un admin general!!");
        Log::alert("Email Global: " . Config::get("mail.from.address"));
    }
});

App::after(function ($request, $response)
{
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth.basic', function ()
{
    return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('tieneSesion?', function ()
{
    if (Auth::check())
    {
        $tipoUsuario = Auth::getUser()->getTipoUsuario();

        if ($tipoUsuario === TipoUsuarioModel::RECLUTADOR)
        {
            return Redirect::route('empresa.inicio');
        }

        if ($tipoUsuario === TipoUsuarioModel::APLICANTE)
        {
            return Redirect::route('aplicante.inicio');
        }

        if ($tipoUsuario === TipoUsuarioModel::ADMIN || $tipoUsuario === TipoUsuarioModel::ADMIN_GENERAL)
        {
            return Redirect::route('admin.inicio');
        }
    }
});

Route::filter('esReclutador?', function ()
{
    if (! Auth::check())
    {
        return Redirect::route('bolsa.inicio');
    }

    $tipoUsuario = Auth::getUser()->getTipoUsuario();

    if ($tipoUsuario != TipoUsuarioModel::RECLUTADOR)
    {
        return Redirect::route('bolsa.inicio');
    }
});

Route::filter('esAplicante?', function ()
{
    if (! Auth::check())
    {
        return Redirect::route('bolsa.inicio');
    }

    $tipoUsuario = Auth::getUser()->getTipoUsuario();

    if ($tipoUsuario != TipoUsuarioModel::APLICANTE)
    {
        return Redirect::route('bolsa.inicio');
    }
});

Route::filter('esAdmin?', function ()
{
    if (! Auth::check())
    {
        return Redirect::route('bolsa.inicio');
    }

    $tipoUsuario = Auth::getUser()->getTipoUsuario();

    if ($tipoUsuario === TipoUsuarioModel::RECLUTADOR)
    {
        return Redirect::route('empresa.inicio');
    }

    if ($tipoUsuario === TipoUsuarioModel::APLICANTE)
    {
        return Redirect::route('aplicante.inicio');
    }
});

Route::filter('esAdminGeneral?', function ()
{
    if (! Auth::check())
    {
        return Redirect::route('bolsa.inicio');
    }

    if (! Auth::getUser()->isGeneralAdmin())
    {
        return Redirect::route("admin.inicio");
    }
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function ()
{
    // cuando el usuario intenta subir un archivo mayor al límite configurado en el .ini
    // el "request" es incapaz de obtener los datos de entrada "Input"
    if(is_null(Input::get('_token')))
    {
        Flash::error("Hubo un problema con el archivo, por favor intenta de nuevo.");
        return Redirect::back()->with("alerta", "Hubo un problema con el archivo, por favor intenta de nuevo.");
    }

    if (Session::token() != Input::get('_token'))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});