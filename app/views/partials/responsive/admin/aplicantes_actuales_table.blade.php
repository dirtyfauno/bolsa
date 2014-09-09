{{ Form::open(array("method" => "get", "class" => "")) }}
<div class="row">
    <div class="form-group col-sm-3">
        {{ Form::select("carrera", $carreras, verify($request, "carrera"), array("class" => "form-control")) }}
    </div>
    <div class="form-group col-sm-3">
        {{ Form::select("universidad", $universidades, verify($request, "universidad"), array("class" => "form-control")) }}
    </div>
    <div class="form-group col-sm-3">
        {{ Form::submit("Buscar", array("class" => "btn btn-success btn-block")) }}
    </div>
    <div class="form-group col-sm-3">
        <a class="btn btn-default btn-block" href="{{ route('admin.aplicantes') }}">Reset</a>
    </div>
</div>
{{ form::close() }}
<br/>
@if(! empty($aplicantes))
<div class="table-responsive">
    <table class="table table-responsive table-hover">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Carrera</th>
            <th>Universidad</th>
            <th>Matricula</th>
            <th>Registro</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($aplicantes as $a)
        <tr>
            <td>{{ $a->present()->nombre }}</td>
            <td>{{ $a->present()->correo }}</td>
            <td>{{ $a->present()->carrera_nombre }}</td>
            <td>{{ $a->present()->universidad }}</td>
            <td>{{ $a->present()->matricula }}</td>
            <td>{{ $a->present()->fecha_registro }}</td>
            <td>
                {{ Form::open(array("route" => "aplicante-status.desactivar")) }}
                {{ Form::hidden("aplicante_id", $a->present()->id) }}
                {{ Form::submit("Desactivar", array("type" => "button", "class" => "btn btn-default")) }}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $aplicantes->appends(array(
"carrera" => verify($request, "carrera"),
"universidad" => verify($request, "universidad")))
->links("pagination.bootstrap3")
}}
@else
<div class="row">
    <p>No hay aplicantes.</p>
</div>
@endif