<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
</head>
<body>
	<div>
		Empresa: <b>{{ $empresa->present()->nombre }}</b>, giro: <b>{{ $empresa->present()->giro }}</b>, teléfono: <b>{{ $empresa->present()->telefono }}</b>
	</div>
	<br>
	<div>
		<i>Feedback:</i> {{ $feedback }}
	</div>
	<h5>
		fecha: {{ \Carbon\Carbon::now()->formatLocalized('%A %d %B del %Y') }}
	</h5>

</body>
</html>
