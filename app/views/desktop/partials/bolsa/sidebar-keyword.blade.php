<!--		 ASIDE: LICENCIATURAS-->
<aside class="carreras clearfix">
  <a class="carrera-general" type="button"
    href="{{ route('bolsa.inicio') }}">Inicio</a>
  @foreach( $carreras as $licenciatura )
    @if( $licenciatura->total > 0 )
      <a class="carrera" type="button"
           href="{{ route('bolsa.carrera.keyword', array($vacantes_tipo, $licenciatura->slug, $keyword)) }}">
        {{ $licenciatura->nombre }} ({{ $licenciatura->total }})
      </a>
    @endif
  @endforeach
</aside>
