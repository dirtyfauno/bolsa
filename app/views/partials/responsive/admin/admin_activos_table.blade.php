<h2 class="text-center page-header">Administradores Secundarios.</h2>
@if($admins->count() == 0)
<p class="text-center">No hay admins creados.</p>
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
            @if($isGeneralAdmin)
            <td>
                {{ Form::open(array("route" => "admin.hacer_principal")) }}
                {{ Form::hidden("admin_id", $admin->present()->id) }}
                {{ Form::submit("Hacer Admin General", array("type" => "button", "class" => "btn btn-primary")) }}
                {{ Form::close() }}
            </td>
            @endif
            <td>
                {{ Form::open(array("route" => "admin.desactivar")) }}
                {{ Form::hidden("admin_id", $admin->present()->id) }}
                {{ Form::submit("Desactivar", array("type" => "button", "class" => "btn btn-default")) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif