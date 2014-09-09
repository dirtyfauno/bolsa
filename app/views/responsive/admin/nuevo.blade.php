@extends("masters.responsive.admin")

@section("main")
{{ Form::open(array("route" => "admin.crear", "class" => "form-horizontal", "role" => "form")) }}
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
        {{ Form::submit("Crear Nuevo Admin", array("class" => "btn btn-default")) }}
    </div>
</div>
{{ Form::close() }}
<br/>
<div class="col-sm-offset-2 col-sm-6">
    @include("partials.responsive.admin.admin_activos_table")
</div>
@stop