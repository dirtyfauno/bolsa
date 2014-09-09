@extends("desktop.masters.inicio")

@section("contenido")
<div class="c-registro-aplicante clearfix">
    {{ Form::open(array('route' => 'registro.aplicante', 'files' => true, 'class' => 'registro-aplicante clearfix')) }}
    <p class="titulo-reg-aplicante">Registro Aplicante </p>

    <div class="c-inputs-aplicante-1 clearfix">
        <div class="c-nombre clearfix">
            {{ Form::text('nombre', null, array('placeholder' => 'Nombre', 'class' => 'nombre')) }}
            {{ mostrar_errores('nombre', $errors) }}
        </div>
        <div class="c-carrera clearfix">
            {{ Form::select('carrera', $carreras, null, array('class' => 'carrera')) }}
            {{ mostrar_errores('carrera', $errors) }}
        </div>
    </div>
    <div class="c-inputs-aplicante-2 clearfix">
        <div class="c-correo clearfix">
            {{ Form::email('email', null, array('placeholder' => 'Correo', 'class' => 'correo')) }}
            {{ mostrar_errores('email', $errors) }}
        </div>
        <div class="c-universidad clearfix">
            {{ Form::select('universidad_id', $universidades, null, array('class' => 'universidad')) }}
            {{ mostrar_errores('universidad_id', $errors) }}
        </div>
    </div>
    <div class="c-inputs-aplicante-3 clearfix">
        <div class="c-matricula clearfix">
            {{ Form::text('matricula', null, array("placeholder" => "Matrícula", "class" => "matricula")) }}
            {{ mostrar_errores('matricula', $errors) }}
        </div>
        <div class="c-cv clearfix">
            {{ Form::label("cv", "Currículum (máx. 1mb)", array("class" => "cv cv-1")) }}
            {{ Form::file("cv", array("class" => "cv cv-2")) }}
            {{ mostrar_errores('cv', $errors) }}
        </div>
    </div>
    <div class="c-inputs-aplicante-4 clearfix">
        <div class="c-pass clearfix">
            {{ Form::password('password', array('placeholder' => 'Contraseña', 'class' => 'pass')) }}
            {{ mostrar_errores('password', $errors) }}
        </div>
        <div class="c-pass2 clearfix">
            {{ Form::password('password_confirmation', array('placeholder' => 'Confirmar Contraseña', 'class' => 'password_confirmation')) }}
            {{ mostrar_errores('password_confirmation', $errors) }}
        </div>
    </div>
    {{ Form::submit('Crear Cuenta', array('class' => 'crear-cuenta-empresa')) }}
    {{ Form::close() }}
</div>
@stop
