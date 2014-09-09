@extends("masters/responsive/admin")
@section("main")
<h3 class="page-header text-center">
    <span class="label label-danger">{{ $empresas->count() }}</span> Empresas Desactivadas
</h3>
@if($empresas->count() == 0)
<p class="text-center">No hay empresas desactivadas.</p>
@else
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
                {{ Form::open(array("route" => "empresa-status.activar")) }}
                {{ Form::hidden("empresa_id", $empresa->id) }}
                {{ Form::submit("Reactivar", array("type" => "button", "class" => "btn btn-primary")) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif
@stop