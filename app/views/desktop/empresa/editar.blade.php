@extends("desktop.masters.inicio")

@section("contenido")

<div id="reg-empresa" class="c-registro-empresa clearfix">
    {{ Form::open(array('route' => 'empresa.update', 'files' => true, 'class' => 'registro-empresa clearfix')) }}
    <p><a href="{{ route('empresa.inicio') }}">Regresar</a></p>

    <p class="titulo-reg-empresa">Actualizar Información</p>

    <div class="c-inputs-reg-empresa-1 clearfix">
        <div class="c-nombre clearfix">
            {{ Form::label("nombre", "Nombre de la Empresa") }}
            {{ Form::text('nombre', $empresa->present()->nombre, array('placeholder' => 'Nombre de Empresa', 'class' => 'nombre')) }}
            {{ mostrar_errores('nombre', $errors) }}
        </div>
        <div class="c-direccion clearfix">
            {{ Form::label("direccion", "Dirección de la Empresa") }}
            {{ Form::text('direccion', $empresa->present()->direccion, array('placeholder' => 'Dirección de la Empresa', 'class' => 'direccion')) }}
            {{ mostrar_errores('direccion', $errors) }}
        </div>
    </div>
    <div class="c-inputs-reg-empresa-2 clearfix">
        <div class="c-giro clearfix">
            {{ Form::label("giro", "Giro de la Empresa") }}
            {{ Form::text('giro', $empresa->present()->giro, array('placeholder' => 'Giro de la Empresa', 'class' => 'giro')) }}
            {{ mostrar_errores('giro', $errors) }}
        </div>
        <div class="c-telefono clearfix">
            {{ Form::label("telefono", "Teléfono") }}
            {{ Form::text('telefono', $empresa->present()->telefono, array('placeholder' => 'Teléfono de la Empresa', 'class' => 'telefono')) }}
            {{ mostrar_errores('telefono', $errors) }}
        </div>
    </div>
    <div class="c-logo clearfix">
        <br/><br/><br/><br/>
        {{ Form::label("logo", "Subir Logo", array("class" => "logo logo-2")) }}
        {{ Form::file("logo", array("class" => "logo logo-3")) }}
        {{ mostrar_errores('logo', $errors) }}
    </div>
    {{ Form::submit('Actualizar Cuenta', array('class' => 'crear-cuenta-empresa')) }}
    {{ Form::close() }}
</div>
@stop
