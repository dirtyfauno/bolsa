@extends("desktop.masters.empresa")

@section("contenido")

@include("partials.desktop.empresa.menu-info")

<div id="menu-items" class="c-menu clearfix">
    @if($vacantes->count() === 0)
    <div class="contenido-menu-2 clearfix">
        <h1 id="menu-1" class="titulo">No Hay Vacantes Cerradas</h1>
    </div>
    @else
    <div class="contenido-menu-2 clearfix">
        <h1 id="menu-1" class="titulo">Últimas Vacantes Cerradas</h1>
    </div>
    @foreach($vacantes as $trabajo)
    <div class="vacante clearfix">
        <div class="c-info-vacante clearfix">
            <span class="tipo-vacante">{{ $trabajo->present()->tipo_vacante}}</span>
            <span class="carrera-vacante">{{ $trabajo->present()->carrera_nombre }}</span>
            <span class="contenido-vacante">
                {{ $trabajo->present()->titulo }}
            </span>
            <!--  aplicantes -->
            <a class="numero-aplicantes"
               href='{{ route("empresa.vacante_aplicantes", array($trabajo->present()->id)) }}'>
                {{ $trabajo->present()->cantidad_aplicantes }} Aplicantes
            </a>
            <!--  reabrir -->
            <a class="cerrar-vacante"
               href="{{ route('empresa.reabrir_vacante', array($trabajo->present()->id)) }}">
                Reabrir
            </a>
        </div>
    </div>
    @endforeach
    @endif

    {{ $vacantes->links() }}

</div>
@stop
