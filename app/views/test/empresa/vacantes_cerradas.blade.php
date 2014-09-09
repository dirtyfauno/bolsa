<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Bolsa de Trabajo: Menú Empresa</title>
</head>
<body>
<h1>empresa: {{ $empresa_nombre }}, inicio</h1>
<li>{{ link_to_route('session.destroy', 'Cerrar Sesión') }}</li>
<li>{{ link_to_route('empresa.vacantes', 'vacantes activas') }} ({{$num_vacantes_activas }})</li>
<h1>Vacantes Cerradas ({{ $num_vacantes_cerradas }})</h1>
<dl>
	@foreach($vacantes as $trabajo)
	<dd>
		<li>
			<span style="color: brown;">
				[{{ $trabajo->present()->carrera_nombre }}]&nbsp;[{{ $trabajo->present()->tipo_vacante}}]&nbsp;
			</span>
			{{ $trabajo->present()->titulo }}
			{{ link_to_route('empresa.vacante_aplicantes', "Aplicantes
			({$trabajo->present()->cantidad_aplicantes})",
			array($trabajo->present()->id)) }}
		</li>
		{{ link_to_route('empresa.reabrir_vacante', "Reabrir Vacante", array($trabajo->present()->id)) }}&nbsp;
	</dd>
	@endforeach
</dl>
{{ $vacantes->links() }}
</body>
</html>
