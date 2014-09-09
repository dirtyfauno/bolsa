@extends("desktop.masters.vacante")

@section("vacante")
<div class="c-nav clearfix">
    <div class="c-links clearfix">
        <a class="btn-atras" type="button" href="{{ route('bolsa.inicio') }}">INICIO</a>
        @if (Auth::check() && Auth::user()->isZorro())
        <a class="btn-mi-perfil" type="button" href="{{ route('aplicante.inicio') }}">MI PERFIL</a>
        <a class="btn-salir" type="button" href="{{ route('session.destroy') }}">SALIR</a>
        @endif
    </div>
</div>
<div class="c-head clearfix">
    <div class="c-titulo clearfix">
        <h1 class="titulo">{{ $vacante->present()->titulo }}</h1>
    </div>
    <p class="tipo-trabajo">Trabajo {{ $vacante->present()->tipo_vacante }} de {{ $vacante->present()->empresa }}</p>
</div>
<div class="c-main clearfix">
    <div class="c-vacante clearfix">
        <div class="c-datos-vacante clearfix">
            <!--        izquierda-->
            <div class="c-optiones-izquierda clearfix">
                <p class="tipo-vacante">Puesto: <span style="color:#f2f2f2;">{{ $vacante->present()->puesto }}</span></p>

                <p class="sueldo">Sueldo Inicial: <span style="color:#f2f2f2;">{{ $vacante->present()->oferta }}</span></p>

                <p class="tipo-estancia">Experiencia: <span style="color:#f2f2f2;">{{ $vacante->present()->experiencia }}</span></p>

                <p class="carrera">{{ $vacante->present()->carrera_nombre }} (
                    <a target="_blank"
                       href="{{ route('bolsa.carrera', array($vacante_tipo, $vacante->present()->carreraSlug)) }}">{{ $carrera_total }} vacantes</a>)</p>
            </div>
            <!--        derecha-->
            <div class="c-optiones-derecha clearfix">
                <p class="tipo-prestacion">Titulación: <span style="color:#f2f2f2;">{{ $vacante->present()->titulado }}</span></p>

                <p class="tipo-sueldo">Área: <span style="color:#f2f2f2;">{{ $vacante->present()->area }}</span></p>

                <p class="nivel-ingles">Inglés: <span style="color:#f2f2f2;">{{ $vacante->present()->nivel_ingles }}</span></p>

                <p class="empresa">{{ $vacante->present()->empresa }} (
                    <a target="_blank"
                       href="{{ route('bolsa.inicio.empresa', array($vacante_tipo, $vacante->present()->empresaSlug)) }}">{{ $total_empresa }} vacantes</a>)</p>
            </div>
        </div>
        <div class="c-checkboxes clearfix">
            {{ p_checkbox($vacante->present()->rotar, "- Disponibilidad para rotar turno") }}
            {{ p_checkbox($vacante->present()->viajar, "- Disponibilidad para viajar") }}
            {{ p_checkbox($vacante->present()->prima, "- Prima vacacional") }}
            {{ p_checkbox($vacante->present()->vales, "- Vales de despensa") }}
            {{ p_checkbox($vacante->present()->transporte, "- Transporte") }}
            {{ p_checkbox($vacante->present()->residencia, "- Cambio de residencia") }}
            {{ p_checkbox($vacante->present()->aguinaldo, "- Aguinaldo") }}
            {{ p_checkbox($vacante->present()->comision, "- Comisión / Bono") }}
            {{ p_checkbox($vacante->present()->seguro, "- Seguro de gastos médicos") }}
            {{ p_checkbox($vacante->present()->comedor, "- Comedor") }}
            {{ p_checkbox($vacante->present()->viaticos, "- Viáticos") }}
            {{ p_checkbox($vacante->present()->gasolina, "- Vales de gasolina") }}
            {{ p_checkbox($vacante->present()->honorarios, "- Honorarios") }}
        </div>
        <p class="fecha">{{ $vacante->present()->fecha }}</p>
        @if(! Auth::check())
        <div class="c-btn-aplicar clearfix">
            <a href="{{ route('registro.aplicante') }}" class="aplicar">Darme de alta para aplicar a la vacante</a>
        </div>
        @elseif(Auth::user()->isZorro() && Auth::user()->aplicante->aplicaciones->contains($vacante->present()->vacante_id) )
        <div class="c-btn-aplicar clearfix">
            <span class="aplicar">Ya has aplicado a esta vacante</span>
        </div>
        @elseif (Auth::user()->isZorro())
        {{ Form::open(array("route" => array("aplicar.vacante", $vacante->present()->id), "class" => "c-btn-aplicar clearfix")) }}
        {{ Form::submit("Aplicar a la Vacante", array("class" => "aplicar")) }}
        {{ Form::close() }}
        @endif
    </div>
    <div class="c-contenido clearfix">
        <p class="contenido">{{ $vacante->present()->contenido }}</p>
    </div>
</div>
@stop
