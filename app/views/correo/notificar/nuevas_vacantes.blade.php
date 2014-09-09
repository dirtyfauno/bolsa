<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bolsa de Trabajo: Nuevas Vacantes</title>
</head>
<body>
<h2>Nuevas Vacantes - {{ $carrera->present()->nombre }}</h2>

@foreach( $vacantes as $vacante )
<li>[{{ $vacante->present()->tipo_vacante }}]
    <a href='{{ route("bolsa.vacante", array($vacante->present()->tipo_vacante,
                                                 $vacante->present()->id,
                                                 $vacante->present()->tituloSlug)) }}'>
        {{ $vacante->present()->titulo }}</a> de {{ $vacante->present()->empresa }}
</li>
@endforeach
</body>
</html>