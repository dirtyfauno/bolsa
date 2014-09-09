{{ Form::open(array("method" => "get", "class" => "")) }}
<div class="row">
    <div class="form-group col-sm-2">
        {{ Form::input("search", "buscar", verify($request, "buscar"), array("class" => "form-control", "placeholder" => "Empresa")) }}
    </div>
    <div class="form-group col-sm-2">
        {{ Form::select("carrera", $carreras, verify($request, "carrera"), array("class" => "form-control")) }}
    </div>
    <div class="form-group col-sm-2">
        {{ Form::select("tipo", $tipos, verify($request, "tipo"), array("class" => "form-control")) }}
    </div>
    <div class="form-group col-sm-2">
        {{ Form::select("ingles", $niveles_ingles, verify($request, "ingles"), array("class" => "form-control")) }}
    </div>
    <div class="form-group col-sm-2">
        {{ Form::submit("Buscar", array("class" => "btn btn-success btn-block")) }}
    </div>
    <div class="form-group col-sm-2">
        <a class="btn btn-default btn-block" href="{{ route('admin.vacantes') }}">Reset</a>
    </div>
</div>
{{ form::close() }}
<br/>
@if(! empty($vacantes))
<div class="table-responsive">
    <table class="table table-responsive table-hover">
        <thead>
        <tr>
            <th>Empresa</th>
            <th>Carrrera</th>
            <th>Titulo</th>
            <th>Tipo</th>
            <th>Inglés</th>
            <th>Titulado</th>
            <th>Oferta</th>
            <th>Experiencia</th>
        </tr>
        </thead>
        <tbody>
        @foreach($vacantes as $v)
        <tr>
            <td>{{ $v->present()->empresa }}</td>
            <td>{{ $v->present()->carrera_nombre }}</td>
            <td>
                <a target="_blank"
                    href="{{ route('bolsa.vacante', array($v->present()->tipo_vacante_slug, $v->present()->id, $v->present()->tituloSlug)) }}">
                    {{ $v->present()->titulo }}
                </a>
            </td>
            <td>{{ $v->present()->tipo_vacante }}</td>
            <td>{{ $v->present()->nivel_ingles }}</td>
            <td>{{ $v->present()->titulado }}</td>
            <td>{{ $v->present()->oferta }}</td>
            <td>{{ $v->present()->experiencia }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $vacantes->appends(array(
"buscar" => verify($request, "buscar"),
"carrera" => verify($request, "carrera"),
"tipo" => verify($request, "tipo"),
"ingles" => verify($request, "ingles")))->links("pagination.bootstrap3") }}
@else
<p>No hay vacantes</p>
@endif