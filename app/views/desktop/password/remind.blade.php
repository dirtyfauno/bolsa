@extends("desktop.masters.inicio")

@section("contenido")
<div class="c-remind clearfix">
    {{ Form::open(array("class" => "remind clearfix")) }}
    <div class="c-inputs clearfix">
        <div class="c-correo clearfix">
            {{ Form::email("email", null, array("placeholder" => "Correo Registrado", "class" => "correo"))}}
        </div>
    </div>
    {{ Form::submit('Recordar Contraseña', array('class' => 'btn-remind')) }}

    {{ Form::close() }}
</div>
@stop
