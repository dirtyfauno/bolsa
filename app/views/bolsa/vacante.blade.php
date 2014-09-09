@extends('master')
@section('contenido')
<p>{{ $vacante->present()->tipo_vacante }}</p><br/>
<h2>titulo: </h2>
<p>{{ $vacante->titulo }}</p><br/>
<h2>carrera: </h2>
<a class="vacante1 clearfix"
   href="{{ URL::route('bolsa.carrera', array(
                    $vacante_tipo,
                    $vacante->present()->carreraSlug)) }}">
    {{ $vacante->present()->carrera }} ({{$carrera_total}} vacantes)
</a>
<h2>oferta: </h2>
<p>{{ $vacante->present()->oferta }}</p><br/>
<h2>empresa: </h2>
<a class="vacante1 clearfix"
   href="{{ URL::route('bolsa.carrera.empresa', array(
                    $vacante_tipo,
                    $vacante->present()->empresaSlug,
                    $vacante->present()->carreraSlug)) }}">
    {{ $vacante->present()->empresa }} ({{$vacantes_totales}} vacantes)
</a>
<h2>contenido:</h2>
<p>{{ $vacante->contenido }}</p><br/>
<h2>tag1: </h2>
<a class="vacante1 clearfix"
   href="{{ URL::route('bolsa.carrera.keyword', array(
                    $vacante_tipo,
                    $vacante->present()->carreraSlug,
                    $vacante->keyword1
                    )) }}">
    {{ $vacante->keyword1 }} ({{$total_keyword1}})
</a>
<p>{{ $vacante->keyword1 }} ({{$total_keyword1}})</p><br/>
<h2>tag2: </h2>
<a class="vacante1 clearfix"
   href="{{ URL::route('bolsa.carrera.keyword', array(
                    $vacante_tipo,
                    $vacante->present()->carreraSlug,
                    $vacante->keyword2
                    )) }}">
    {{ $vacante->keyword2 }} ({{$total_keyword2}})
</a>
<p>{{ $vacante->keyword2 }} ({{$total_keyword2}})</p><br/>
@stop
