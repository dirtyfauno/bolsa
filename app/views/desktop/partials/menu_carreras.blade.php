<!--		 ASIDE: LICENCIATURAS-->
<aside class="carreras clearfix">
  <a class="carrera-general" type="button" href="#">Inicio</a>
  @foreach( $carreras as $licenciatura )
    @if( $licenciatura->total > 0 )
      <a class="carrera" type="button"
           href="{{ route('bolsa.carrera', array($vacantes_tipo, $licenciatura->slug)) }}">
        {{ $licenciatura->nombre }} ({{ $licenciatura->total }})
      </a>
    @endif
  @endforeach
</aside>
