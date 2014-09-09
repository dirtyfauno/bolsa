<!--		 ASIDE: LICENCIATURAS-->
<aside class="carreras clearfix">
  <a class="carrera-general" type="button"
    href="{{ route('bolsa.inicio') }}">Inicio</a>
  @foreach( $carreras as $licenciatura )
      <a class="carrera" type="button"
           href="{{ route('bolsa.carrera', array($vacantes_tipo, $licenciatura->slug)) }}">
        {{ $licenciatura->nombre }} ({{ $licenciatura->total }})
      </a>
  @endforeach
</aside>
