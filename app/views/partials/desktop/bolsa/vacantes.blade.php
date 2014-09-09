@foreach( $vacantes as $indice => $trabajo )
<a class="vacante1 clearfix"
   href="{{ route('bolsa.vacante', array($vacantes_tipo, $trabajo->present()->id, $trabajo->present()->tituloSlug)) }}">
    <div class="vacante-info clearfix">
        <h2 class="titulo">
            <span style="color: black;">{{ $trabajo->present()->empresa }}:</span>
            "{{ $trabajo->present()->titulo }}"
        </h2>
        @if(Auth::check() && Auth::user()->isZorro())
        @if(Auth::user()->aplicante->aplicaciones->contains($trabajo->present()->vacante_id))
        <div class="oferta-sueldo-horario" style="color: rgb(242, 242, 242);">
            Ya has aplicado a esta vacante
        </div>
        @else
        <div class="oferta-sueldo-horario">
            {{ $trabajo->present()->oferta }}
        </div>
        <div class="carrera-fecha">
            {{ $trabajo->present()->carrera_nombre }}, {{ $trabajo->present()->fecha }}
        </div>
        @endif
        @else
        <div class="oferta-sueldo-horario">
            {{ $trabajo->present()->oferta }}
        </div>
        <div class="carrera-fecha">
            {{ $trabajo->present()->carrera_nombre }}, {{ $trabajo->present()->fecha }}
        </div>
        @endif
    </div>
</a>
@endforeach
{{ $vacantes->links() }}