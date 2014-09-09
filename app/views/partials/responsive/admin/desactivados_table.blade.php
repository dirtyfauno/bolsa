<h2 class="text-center page-header">Administradores Desactivados</h2>
@if($admins->count() == 0)
<p class="text-center">No hay admins desactivados.</p>
@else
<div class="table-responsive">
    <table class="table table-responsive table-hover">
        <thead>
        <tr>
            <th>Correo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($admins as $admin)
        <tr>
            <td>{{ $admin->present()->correo }}</td>
            <td>
                {{ Form::open(array("route" => "admin.activar")) }}
                {{ Form::hidden("admin_id", $admin->present()->id) }}
                {{ Form::submit("Reactivar", array("type" => "button", "class" => "btn btn-primary")) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif