<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Bolsa de Trabajo</title>
</head>
<body>
<h1>login empresa</h1>
{{ Form::open(array('route' => 'ingreso.post')) }}
<br/>
	{{ Form::label('email', 'Correo del Reclutador:') }}
	{{ Form::email('email', null, array('placeholder' => 'reclutamiento@empresa.com', 'required' => 'required')) }}
	{{ $errors->first('email', '<span style="color: brown;">:message</span>') }}
<br/>
	{{ Form::label('password', 'Contraseña:') }}
	{{ Form::password('password', array('placeholder' => 'oifn230uf23i', 'required' => 'required')) }}
{{ Form::close() }}
{{link_to_route('registro.empresa', 'Registro Empresas')}}
</body>
</html>