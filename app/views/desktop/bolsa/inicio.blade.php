@extends("desktop.masters.inicio")

@section("contenido")
<div id="seleccion" class="c-opciones c-opciones-1 clearfix">
    <div class="c-botones clearfix">
        <a class="btn-practicantes" href="{{ route('bolsa.vacantes', array('practicante')) }}">Practicantes ({{ $vacantes_practicantes }})</a>
        <a class="btn-formal" href="{{ route('bolsa.vacantes', array('formal')) }}">Formales ({{ $vacantes_formales }})</a>
    </div>
</div>

@if (Auth::check())
<div id="en-sesion" class="c-opciones c-opciones-4 clearfix">
    <div class="iniciar clearfix">
        @if (Auth::user()->isZorro())
        <a class="menu-inicio" href="{{ route('zorro.inicio') }}">Ir a mi Menú</a>
        @elseif (Auth::user()->isReclutador())
        <a class="menu-inicio" href="{{ route('empresa.inicio') }}">Ir a mi Menú</a>
        @else
        <a class="menu-inicio" href="{{ route('admin.inicio') }}">Ir a mi Menú</a>
        @endif
    </div>
</div>
@else
<div id="login" class="c-opciones c-opciones-3 clearfix">
    {{ Form::open(array('route' => 'ingreso.post', 'class' => 'inicio-zorros clearfix')) }}
    <div class="c-inputs clearfix">
        <div class="c-correo clearfix">
            <input class="correo" name="email" placeholder="Correo" type="text">
            {{ mostrar_errores('email', $errors, '#f2f2f2') }}
        </div>
        <div class="c-password clearfix">
            <input class="password" name="password" placeholder="Contraseña" type="password">
            {{ mostrar_errores('password', $errors, '#f2f2f2') }}
        </div>
    </div>
    {{ Form::submit('Iniciar Sesion', array('class' => 'btn-iniciar')) }}
    {{ Form::close() }}
</div>

<div id="bottom-links" class="c-bottom-links clearfix">
    <a class="registro" href="{{ route('empresa.registro') }}">Registro Empresas</a>
    <a class="recuperar" href="{{ url('password/remind') }}">Recuperar Contraseña</a>
</div>
@endif
@stop
