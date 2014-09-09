<div id="menu-info" class="c-menu c-menu-1 clearfix">
    <div class="titulo-menu-1 clearfix">
        <h1 class="titulo">{{ $empresa->present()->nombre }}</h1>
    </div>
    <div class="info-empresa clearfix">
        <div class="logo-empresa"></div>
        <span class="correo-reclutador">reclutador: {{ $empresa->present()->correo }}</span>
        <span class="tel-empresa">teléfono: {{ $empresa->present()->telefono }}</span>
        <a class="vacantes-cerradas"
           href="{{ route('empresa.vacantes_cerradas') }}">
            {{ $vacantes_cerradas }} Vacantes Cerradas
        </a>
        <a class="editar-info-empresa" href="{{ route('empresa.editar') }}">Editar Información</a>
    </div>
</div>