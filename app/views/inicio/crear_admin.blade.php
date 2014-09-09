<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/admin/admin-bootstrap-min.css">
    <style>
        @import url(http://fonts.googleapis.com/css?family=Muli:300,100,400,400|Josefin+Slab:100,400);

        body {
            font: 100 1.125em/1.38;
            font-family: 'Muli', 'sans-serif';
        }
    </style>
</head>
<body>
<br/>

<div class="container">
    @include('flash::message')
    <h2 class="page-header text-center">Crear Admin General</h2>

    <p class="text-center bg-info">
        Este es el usuario del que se utilizará para enviar los correo del sistema a las empresas, y de nuevas vacantes.
    </p>
    {{ Form::open(array("route" => "admin.crear_admin_principal", "class" => "form-horizontal", "role" => "form")) }}
    <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>

        <div class="col-sm-7">
            {{ Form::email("email", null, array("class" => "form-control", "placeholder" => "Correo")) }}
            {{ mostrar_errores('email', $errors) }}
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Password</label>

        <div class="col-sm-7">
            {{ Form::password("password", array("class" => "form-control", "placeholder" => "Contraseña")) }}
            {{ mostrar_errores('password', $errors) }}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-7">
            {{ Form::submit("Crear Nuevo Admin General", array("class" => "btn btn-primary btn-block")) }}
        </div>
    </div>
    {{ Form::close() }}
</div>
</body>
</html>