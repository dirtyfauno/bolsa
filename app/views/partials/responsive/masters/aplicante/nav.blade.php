<div class="masthead clearfix">
    <div class="inner">
        @include('flash::message')
        <h3 class="masthead-brand">{{ $aplicante->present()->nombre }}, {{ $aplicante->present()->carrera_nombre }}</h3>
        <ul class="nav masthead-nav">
            <li><a target="_blank" href="{{ route('bolsa.carrera', array('formal', $aplicante->present()->carrera_slug)) }}">
                    Formales ({{ $vacantes_f_c }})</a></li>
            <li><a target="_blank" href="{{ route('bolsa.carrera', array('practicante', $aplicante->present()->carrera_slug)) }}">
                    Practicante ({{ $vacantes_p_c }})</a></li>
            <li><a target="_blank" href="{{ route('estadisticas') }}">
                    Estadísticas</a></li>
            <li><a href="{{ route('session.destroy') }}">
                    Salir</a></li>
        </ul>

    </div>

</div>
