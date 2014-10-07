<?php

// http://laravel.com/docs/routing#route-filters
Route::when("*", "csrf", array(
    "post",
    "put",
    "patch"
));

// bolsa.php
Route::group(array('prefix' => 'trabajo'), function ()
{
    /* página de vacantes por carrera */
    Route::get('{tipo_trabajo}/carrera/{carrera}', array(
        'as'   => 'bolsa.carrera',
        'uses' => 'BolsaController@vacantes_de_carrera'));

    /* página de vacantes por carrera y keyword */
    Route::get('{tipo_trabajo}/carrera/{carrera}/keyword/{keyword}', array(
        'as'   => 'bolsa.carrera.keyword',
        'uses' => 'BolsaController@vacantes_de_keyword'));

    /* página de vacantes de carrera por empresa */
    Route::get('{tipo_trabajo}/empresa/{empresa}/carrera/{carrera}', array(
        'as'   => 'bolsa.carrera.empresa',
        'uses' => 'BolsaController@vacantes_de_carrera_por_empresa'));

    /* página de vacantes por empresa */
    Route::get('{tipo_trabajo}/empresa/{empresa}', array(
        'as'   => 'bolsa.inicio.empresa',
        'uses' => 'BolsaController@vacantes_de_empresa'));

    /* página de vacante individual */
    Route::get('{tipo_trabajo}/{vacante}/{titulo}', array(
        'as'   => 'bolsa.vacante',
        'uses' => 'BolsaController@vacante'));

    /* página principal */
    Route::get('{tipo_trabajo}', array(
        'as'   => 'bolsa.vacantes',
        'uses' => 'BolsaController@mostrar_vacantes'));
});

/* página principal */
Route::get('/', array(
    'as'     => 'bolsa.inicio',
    "before" => "tieneSesion?",
    'uses'   => 'BolsaController@seleccion'
));

Route::post('/ingreso', array(
    'as'   => 'ingreso.post',
    'uses' => 'SessionController@ingreso'
));

Route::get('logout', array(
    'as'   => 'session.destroy',
    'uses' => 'SessionController@destroy'
));

/* Mostrar estadísticas */
Route::get('estadisticas/{tabla?}', array(
    'as'   => 'estadisticas',
    'uses' => 'EstadisticasController@index'
));

// registro.php
Route::group(array('prefix' => 'registro', "before" => "tieneSesion?"), function ()
{
    Route::get('empresa', array(
        'as'   => 'empresa.registro',
        'uses' => 'RegistroController@registroEmpresa'
    ));

    Route::post('empresa', array(
        'as'     => 'registro.empresa',
        'uses'   => 'RegistroController@empresa'
    ));

    Route::get('aplicante', array(
        'as'   => 'aplicante.registro',
        'uses' => 'ZorroController@registro'
    ));

    Route::post('aplicante', array(
        'as'   => 'registro.aplicante',
        'uses' => 'RegistroController@aplicante'
    ));
});

Route::post('correo/empresa', array(
    'as'   => 'correo.empresa_feedback',
    'uses' => 'CorreoController@empresa_feedback'
));

// empresa.php
Route::group(array('prefix' => 'empresa', 'before' => 'esReclutador?'), function ()
{
    Route::get('/', array(
        'as'   => 'empresa.inicio',
        'uses' => 'EmpresaController@inicio'
    ));

    Route::get('editar', array(
        'as'   => 'empresa.editar',
        'uses' => 'EmpresaController@editar'
    ));

    Route::post('update', array(
        'as'   => 'empresa.update',
        'uses' => 'EmpresaController@update'
    ));

    Route::get('aplicante', array(
        'as'   => 'cv.getByFilename',
        'uses' => 'CurriculumController@getByFileName'
    ));

    Route::get('vacante/nueva', array(
        'as'   => 'empresa.crear_vacante',
        'uses' => 'EmpresaController@crear_vacante'
    ));

    Route::get('aplicantes', array(
        'as'   => 'empresa.aplicantes',
        'uses' => 'EmpresaController@mostrar_aplicantes'
    ));

    Route::get('feedback', array(
        'as'   => 'empresa.feedback',
        'uses' => 'EmpresaController@enviar_feedback'
    ));

    Route::post('vacante/nueva', array(
        'as'   => 'vacante.nueva',
        'uses' => 'VacanteController@nueva'
    ));

    Route::put('vacante/{id}/actualizar', array(
        'as'   => 'vacante.actualizar',
        'uses' => 'VacanteController@actualizar'
    ));

    Route::get('vacante/{id}/cerrar', array(
        'as'   => 'empresa.cerrar_vacante',
        'uses' => 'EmpresaController@cerrar_vacante'
    ));

    Route::get('vacante/{id}/reabrir', array(
        'as'   => 'empresa.reabrir_vacante',
        'uses' => 'EmpresaController@reabrir_vacante'
    ));

    Route::get('vacante/{id}/editar', array(
        'as'   => 'empresa.editar_vacante',
        'uses' => 'EmpresaController@editar_vacante'
    ));

    Route::get('vacante/{id}/aplicantes', array(
        'as'   => 'empresa.vacante_aplicantes',
        'uses' => 'EmpresaController@vacante_aplicantes'
    ));

    Route::get('vacantes/activas', array(
        'as'   => 'empresa.vacantes',
        'uses' => 'EmpresaController@vacantes_activas'
    ));

    Route::get('vacantes/cerradas', array(
        'as'   => 'empresa.vacantes_cerradas',
        'uses' => 'EmpresaController@vacantes_cerradas'
    ));
});

Route::group(array("prefix" => "empresa/status", "before" => "esAdmin?"), function ()
{
    Route::post("desactivar", array(
        "as"   => "empresa-status.desactivar",
        "uses" => "EmpresaStatusController@desactivar"
    ));

    Route::post("activar", array(
        "as"   => "empresa-status.activar",
        "uses" => "EmpresaStatusController@activar"
    ));

    Route::post("rechazar", array(
        "as"   => "empresa-status.rechazar",
        "uses" => "EmpresaStatusController@rechazar"
    ));

    Route::post("restaurar", array(
        "as"   => "empresa-status.restaurar",
        "uses" => "EmpresaStatusController@restaurar"
    ));
});

// aplicante
Route::group(array("prefix" => "aplicante", "before" => "esAplicante?"), function ()
{
    Route::get("/", array(
        "as"   => "aplicante.inicio",
        "uses" => "AplicanteController@inicio"
    ));

    Route::post("actualizar", array(
        "as"   => "aplicante.actualizar",
        "uses" => "AplicanteController@update"
    ));

    Route::get("cv", array(
        "as"   => "aplicante.cv",
        "uses" => "AplicanteController@cv"
    ));
});

// aplicante-status
Route::group(array("prefix" => "aplicante/status", "before" => "esAdmin?"), function ()
{
    Route::post("desactivar", array(
        "as"   => "aplicante-status.desactivar",
        "uses" => "AplicanteStatusController@desactivar"
    ));

    Route::post("activar", array(
        "as"   => "aplicante-status.activar",
        "uses" => "AplicanteStatusController@activar"
    ));
});

// egresado.php
Route::group(array(
    'prefix' => 'zorro',
    'before' => 'tiene.sesion?|es.zorro?'), function ()
{
    Route::get('/', array(
        'as'   => 'zorro.inicio',
        'uses' => 'ZorroController@inicio'));

    Route::post('aplicar/{id}', array(
        'as'   => 'aplicar.vacante',
        'uses' => 'AplicacionController@vacante'));
});

// admin
Route::group(array("prefix" => "administracion", "before" => "esAdmin?"), function ()
{
    Route::get("/", array(
        "as"   => "admin.inicio",
        "uses" => "AdminController@index"
    ));

    Route::get("desactivados", array(
        "as"   => "admin.desactivados",
        "uses" => "AdminController@desactivados"
    ));

    Route::post("desactivar", array(
        "as"   => "admin.desactivar",
        "uses" => "AdminController@desactivar"
    ));

    Route::post("activar", array(
        "as"   => "admin.activar",
        "uses" => "AdminController@activar"
    ));

    Route::get("nuevo", array(
        "as"     => "admin.nuevo",
        "before" => "esAdminGeneral?",
        "uses"   => "AdminController@nuevo"
    ));

    Route::post("crear", array(
        "as"     => "admin.crear",
        "before" => "esAdminGeneral?",
        "uses"   => "AdminController@crear"
    ));

    Route::post("crear-pricipal", array(
        "as"     => "admin.crear_admin_principal",
        "uses"   => "AdminController@crearPrincipal"
    ));

    Route::post("hacer-pricipal", array(
        "as"   => "admin.hacer_principal",
        "uses" => "AdminController@hacerPrincipal"
    ));

    Route::get("vacantes", array(
        "as"   => "admin.vacantes",
        "uses" => "AdminController@vacantes"
    ));

    Route::get("aplicantes", array(
        "as"   => "admin.aplicantes",
        "uses" => "AdminController@aplicantes_actuales"
    ));

    Route::get("aplicantes-desactivados", array(
        "as"   => "admin.aplicantes_desactivados",
        "uses" => "AdminController@aplicantes_desactivados"
    ));

    Route::get("empresas-activas", array(
        "as"   => "admin.empresas_activas",
        "uses" => "AdminController@empresas_activas"
    ));

    Route::get("empresas-rechazadas", array(
        "as"   => "admin.empresas_rechazadas",
        "uses" => "AdminController@empresas_rechazadas"
    ));

    Route::get("empresas-desactivadas", array(
        "as"   => "admin.empresas_desactivadas",
        "uses" => "AdminController@empresas_desactivadas"
    ));

    Route::get("empresa/{empresa_slug}", array(
        "as"   => "admin.empresa",
        "uses" => "AdminController@empresa_info"
    ));
});

Route::controller('password', 'RemindersController');

App::missing(function()
{
    $url = Request::fullUrl();
    Log::warning("404 for URL: $url");
    return Redirect::route("bolsa.inicio");
});