@extends("desktop.masters.inicio")

@section("contenido")
<div class="c-reset clearfix">
    {{ Form::open(array("class" => "reset clearfix")) }}
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="c-inputs clearfix">
        <div class="c-correo clearfix">
            {{ Form::email('email', null, array('placeholder' => 'Correo', "class" => "correo")) }}
            {{ mostrar_errores('email', $errors) }}
        </div>
        <div class="c-password clearfix">
            {{ Form::password('password', array('placeholder' => 'Nueva Contraseña', "class" => "password")) }}
            {{ mostrar_errores('password', $errors) }}
        </div>
        <div class="c-password clearfix">
            {{ Form::password('password_confirmation', array('placeholder' => 'Repetir Contraseña', "class" => "password")) }}
            {{ mostrar_errores('password_confirmation', $errors) }}
        </div>
    </div>
    {{ Form::submit('Reset', array("class" => "btn-reset")) }}
    {{ Form::close() }}
</div>
@stop
