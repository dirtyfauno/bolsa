@if($e_pendientes_c == 0)
<p class="text-center">No hay empresas pendientes.</p>
@else
<div class="table-responsive">
    <table class="table table-responsive table-hover">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>RFC</th>
            <th>Giro</th>
            <th>Reclutador</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($empresas as $empresa)
        <tr>
            <td><a href="{{ route('admin.empresa', array($empresa->present()->slug)) }}">{{ $empresa->present()->nombre }}</a></td>
            <td>{{ $empresa->present()->rfc }}</td>
            <td>{{ $empresa->present()->giro }}</td>
            <td>{{ $empresa->present()->reclutador }}</td>
            <td>{{ $empresa->present()->correo }}</td>
            <td>{{ $empresa->present()->telefono }}</td>
            <td>
                {{ Form::open(array("route" => "empresa-status.activar")) }}
                {{ Form::hidden("empresa_id", $empresa->id) }}
                {{ Form::submit("Activar", array("type" => "button", "class" => "btn btn-primary")) }}
                {{ Form::close() }}
            </td>
            <td>
                {{ Form::open(array("route" => "empresa-status.desactivar")) }}
                {{ Form::hidden("empresa_id", $empresa->id) }}
                {{ Form::submit("Rechazar", array("type" => "button", "class" => "btn btn-danger")) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif