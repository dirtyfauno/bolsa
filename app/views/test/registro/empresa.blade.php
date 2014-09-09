@extends("desktop.masters.inicio")

@section("contenido")
<div id="reg-empresa" class="c-registro-empresa clearfix">
    {{ Form::open(array('route' => 'registro.empresa', 'files' => true, 'class' => 'registro-empresa clearfix')) }}
    <p class="titulo-reg-empresa">Registro Empresa</p>

    <div class="c-inputs-reg-empresa-1 clearfix">
        <div class="c-nombre clearfix">
            {{ Form::text('nombre', null, array('placeholder' => 'Nombre de Empresa', 'class' => 'nombre')) }}
            {{ mostrar_errores('nombre', $errors) }}
        </div>
        <div class="c-direccion clearfix">
            {{ Form::text('direccion', null, array('placeholder' => 'Dirección de la Empresa', 'class' => 'direccion')) }}
            {{ mostrar_errores('direccion', $errors) }}
        </div>
    </div>
    <div class="c-inputs-reg-empresa-2 clearfix">
        <div class="c-giro clearfix">
            {{ Form::text('giro', null, array('placeholder' => 'Giro de la Empresa', 'class' => 'giro')) }}
            {{ mostrar_errores('giro', $errors) }}
        </div>
        <div class="c-telefono clearfix">
            {{ Form::text('telefono', null, array('placeholder' => 'Teléfono de la Empresa', 'class' => 'telefono')) }}
            {{ mostrar_errores('telefono', $errors) }}
        </div>
    </div>
    <div class="c-inputs-reg-empresa-3 clearfix">
        <div class="c-correo-reclutador clearfix">
            {{ Form::email('email', null, array('placeholder' => 'Correo del Reclutador', 'class' => 'email')) }}
            {{ mostrar_errores('email', $errors) }}

        </div>
        <div class="c-rfc clearfix">
            {{ Form::text('rfc', null, array("placeholder" => "RFC Empresa", "class" => "rfc")) }}
            {{ mostrar_errores('rfc', $errors) }}
        </div>
    </div>
    <div class="c-inputs-reg-empresa-4 clearfix">
        <div class="c-pass clearfix">
            {{ Form::password('password', array('placeholder' => 'Contraseña', 'class' => 'pass')) }}
            {{ mostrar_errores('password', $errors) }}
        </div>
        <div class="c-pass2 clearfix">
            {{ Form::password('password_confirmation', array('placeholder' => 'Confirmar Contraseña', 'class' => 'password_confirmation')) }}
            {{ mostrar_errores('password_confirmation', $errors) }}
        </div>
    </div>
    <div class="c-inputs-reg-empresa-5 clearfix">
        <div class="c-reclutador clearfix">
            {{ Form::text('reclutador_nombre', null, array('placeholder' => 'Nombre del Reclutador', 'class' => 'reclutador')) }}
            {{ mostrar_errores('reclutador_nombre', $errors) }}
        </div>
        <div class="c-logo clearfix">
            {{ Form::label("logo", "Subir Logo", array("class" => "logo logo-2")) }}
            {{ Form::file("logo", array("class" => "logo logo-3")) }}
            {{ mostrar_errores('logo', $errors) }}
        </div>
    </div>
    {{ Form::submit('Crear Cuenta', array('class' => 'crear-cuenta-empresa')) }}
    {{ Form::close() }}
</div>
@stop
