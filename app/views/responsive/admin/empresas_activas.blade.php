@extends("masters/responsive/admin")
@section("main")
<h3 class="page-header text-center">
    <span class="label label-danger">{{ $empresas->count() }}</span> Empresas Activas
</h3>
@if($empresas->count() > 0)
<div class="table-responsive">
    <table class="table table-responsive table-hover">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Giro</th>
            <th>Reclutador</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($empresas as $empresa)
        <tr>
            <td><a href="{{ route('admin.empresa', array($empresa->present()->slug)) }}">{{ $empresa->present()->nombre }}</a></td>
            <td>{{ $empresa->present()->giro }}</td>
            <td>{{ $empresa->present()->nombre }}</td>
            <td>{{ $empresa->present()->correo }}</td>
            <td>{{ $empresa->present()->telefono }}</td>
            <td>
                {{ Form::open(array("route" => "empresa-status.desactivar")) }}
                {{ Form::hidden("empresa_id", $empresa->id) }}
                {{ Form::submit("Desactivar", array("type" => "button", "class" => "btn btn-default")) }}
                {{ Form::close() }}
            </td>
            <!--                  <td>{{ $empresa->present()->ubicacion }}</td>-->
            <!--                  <td>{{ $empresa->present()->direccion }}</td>-->
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@else
<p class="text-center">No hay empresas activas.</p>
@endif
@stop