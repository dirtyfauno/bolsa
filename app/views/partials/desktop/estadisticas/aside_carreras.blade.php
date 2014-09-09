<aside class="carreras clearfix">
    <a class="carrera-general" type="button" href="{{ route('estadisticas') }}">GENERAL</a>
    @foreach($carreras as $carrera)
    <a class="carrera" type="button" href="{{ route('estadisticas', array($carrera->present()->slug )) }}">{{ $carrera->present()->nombre }}</a>
    @endforeach
</aside>