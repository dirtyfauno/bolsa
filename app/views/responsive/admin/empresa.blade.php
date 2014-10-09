@extends("masters/responsive/admin")
@section("main")
<h1 class="page-header">
    <img src="{{ asset('images/empresa_logo/' . $empresa->logo) }}" alt="{{ $empresa->logo or 'none' }}" class="img-thumbnail">
    {{ $empresa->present()->nombre }}
    <small>{{ $empresa->present()->status }}</small>
</h1>
<div class="jumbotron">

    <p><a href="{{ URL::previous() }}">Regresar</a></p>

    <p><strong>Correo Reclutador:</strong> {{ $empresa->present()->correoReclutador }}</p>

    <p><strong>RFC:</strong> {{ $empresa->present()->rfc }}</p>

    <p><strong>Giro:</strong> {{ $empresa->present()->giro }}</p>

    <p><strong>Telefono:</strong> {{ $empresa->present()->telefono }}</p>

    <p><strong>Dirección:</strong> {{ $empresa->present()->direccion }}</p>
</div>
@stop
