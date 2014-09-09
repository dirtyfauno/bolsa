@extends("masters/responsive/aplicante")
@section("main")
<br/><br/><br/><br/><br/><br/><br/>
{{ Form::open(array("route" => "aplicante.actualizar", "files" => true)) }}
{{ Form::hidden("aplicante_id", $aplicante->present()->id) }}
<div class="row">
    <span class="col-sm-4">
        {{ Form::label("nombre", "Nombre") }}
        {{ Form::text("nombre", $aplicante->present()->nombre, array("class" => "text-center form-control")) }}
        {{ mostrar_errores('nombre', $errors, "white") }}
    </span>
    <span class="col-sm-4">
        {{ Form::label("carrera", "Carrera") }}
        {{ Form::select("carrera", $carreras, $aplicante->present()->carrera_id, array("class" => "text-center form-control")) }}
        {{ mostrar_errores('carrera', $errors,"white") }}
    </span>
    <span class="col-sm-4">
        <br/>
        <a class="btn btn-primary btn-block" href="{{ route('aplicante.cv') }}">Mi Currículum</a>
    </span>
</div>
<br/>
<div class="row">
    <span class="col-sm-4">
        {{ Form::label("universidad_id", "Universidad") }}
        {{ Form::select("universidad_id", $universidades, $aplicante->present()->universidad_id, array("class" => "text-center form-control")) }}
        {{ mostrar_errores('universidad_id', $errors, "white") }}
    </span>
    <span class="col-sm-4">
        {{ Form::label("matricula", "Matrícula") }}
        {{ Form::text("matricula", $aplicante->present()->matricula, array("class" => "text-center form-control")) }}
        {{ mostrar_errores('matricula', $errors, "white") }}
    </span>
    <span class="col-sm-4">
        {{ Form::label("cv", "Currículum") }}
        {{ Form::file("cv") }}
        {{ mostrar_errores('cv', $errors, "white") }}
    </span>
</div>
<br/>
<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox("mailing", '1', $aplicante->present()->mailing) }} Recibir vacantes en mi correo
    </div>
    <div class="col-md-4">
        {{ Form::submit("Actualizar Información", array("class" => "btn btn-default btn-block text-center")) }}
    </div>
</div>
{{ Form::close() }}
<br/>
<h4 class="cover-heading">Últimas aplicaciones en vacantes activas</h4>
<div class="row">
    @if($aplicaciones->getTotal() > 0)
    <div class="table-responsive">
        <table class="table table-condensed table-responsive">
            <thead>
            <tr>
                <th class="text-center">Empresa</th>
                <th class="text-center">Vacante</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Oferta</th>
            </tr>
            </thead>
            <tbody>
            @foreach($aplicaciones as $aplicacion)
            <tr>
                <td>{{ $aplicacion->empresa->present()->nombre }}</td>
                <td>{{ $aplicacion->present()->titulo }}</td>
                <td>{{ $aplicacion->present()->tipo_vacante }}</td>
                <td>{{ $aplicacion->present()->oferta }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $aplicaciones->links("pagination.bootstrap3") }}
    @else
    <p>No tienes aplicaciones aún.</p>
    @endif
</div>
@stop
