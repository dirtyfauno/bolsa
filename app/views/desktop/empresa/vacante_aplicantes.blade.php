@extends("desktop.masters.empresa")

@section("contenido")

@include("partials.desktop.empresa.menu-info")

<div id="aplicantes" class="c-menu clearfix">
    @if($vacante->present()->cantidad_aplicantes === 0)
    <div class="contenido-menu-2 clearfix">
        <h1 id="menu-1" class="titulo">No hay Aplicantes</h1>
    </div>
    @else
    <div class="contenido-menu-2 clearfix">
        <h1 id="menu-1" class="titulo">Aplicantes</h1>
    </div>
    @foreach ($vacante->aplicantes as $aplicante)
    <div class="vacante clearfix">
        <div class="c-info-aplicante clearfix">
            <span class="aplicante">{{ $aplicante->present()->correo }}</span>
            <a class="descargar" href="{{ route('cv.getByFilename', array('cv' => $aplicante->present()->cv)) }}">Currículum</a>
            <span class="fecha">actualizado: {{ $aplicante->present()->actualizado }}</span>
        </div>
    </div>
    @endforeach
    @endif
</div>
@stop
