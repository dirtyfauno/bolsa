<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Bolsa de Trabajo: Menú Empresa</title>
</head>
<body>
<h1>empresa (id: {{ $empresa->id }}): {{ $empresa->nombre }} (user: {{ $empresa->user_id }})</h1>
<li>{{ link_to_route('session.destroy', 'Cerrar Sesión') }}</li>
<li>{{ link_to_route('empresa.vacantes_cerradas', 'vacantes cerradas') }} ({{ $vacantes_cerradas }})</li>
<li>{{ link_to_route('empresa.crear_vacante', 'crear vacante') }}</li>
<h1>Vacantes ({{ $vacantes_activas }})</h1>
<dl>
	@foreach($vacantes as $trabajo)
	<dd>
		<li>
			<span style="color: brown;">
				[{{ $trabajo->present()->carrera_nombre }}]&nbsp;[{{ $trabajo->present()->tipo_vacante}}]
			</span>
			{{ $trabajo->present()->titulo }}
			&nbsp;
			{{ link_to_route('empresa.vacante_aplicantes', "Aplicantes ({$trabajo->present()->cantidad_aplicantes})",
			 array($trabajo->present()->id)) }}
		</li>
		{{ link_to_route('empresa.cerrar_vacante', "Cerrar Vacante", array($trabajo->present()->id)) }}&nbsp;
		{{ link_to_route('empresa.editar_vacante', "Editar Vacante", array($trabajo->present()->id)) }}
	</dd>
	@endforeach
</dl>
{{ $vacantes->links() }}
</body>
</html>