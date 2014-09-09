@extends("desktop.masters.empresa")

@section("contenido")

@include("partials.desktop.empresa.menu-info")

<!--  vacantes -->
<div id="menu-items" class="c-menu clearfix">
    <div class="contenido-menu-2 clearfix">
        <h1 id="menu-1" class="titulo">
            Últimas Vacantes Actualizadas
            (<a href="{{ route('empresa.crear_vacante') }}">crear nueva vacante</a>)
        </h1>
    </div>
    @foreach($vacantes as $trabajo)
    <div class="vacante clearfix">
        <div class="c-info-vacante clearfix">
            <span class="tipo-vacante">{{ $trabajo->present()->tipo_vacante}}</span>
            <span class="carrera-vacante">{{ $trabajo->present()->carrera_nombre }}</span>

            <a class="contenido-vacante" target="_blank"
               href="{{ route('bolsa.vacante', array($trabajo->present()->tipo_vacante_slug, $trabajo->present()->id, $trabajo->present()->tituloSlug)) }}">
                {{ $trabajo->present()->titulo }}
            </a>
            <a class="numero-aplicantes"
               href='{{ route("empresa.vacante_aplicantes", array($trabajo->present()->id)) }}'>
                {{ $trabajo->present()->cantidad_aplicantes }} Aplicantes
            </a>
            <a class="editar-vacante"
               href="{{ route('empresa.editar_vacante', array($trabajo->present()->id)) }}">
                Editar
            </a>
            <a class="cerrar-vacante"
               href="{{ route('empresa.cerrar_vacante', array($trabajo->present()->id)) }}">
                Cerrar
            </a>
        </div>
    </div>
    @endforeach

    {{ $vacantes->links() }}

</div>
@stop
