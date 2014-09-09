<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>reset</h1>
{{ Form::open() }}

	<input type="hidden" name="token" value="{{ $token }}">

	{{ Form::label('email', 'Correo:') }}
	{{ Form::email('email', null, array('placeholder' => 'mi@correo.com')) }}
	{{ mostrar_errores('email', $errors) }}
	<br/>
	{{ Form::label('password', 'Contraseña:') }}
	{{ Form::password('password', array('placeholder' => 'oifn230uf23i')) }}
	{{ mostrar_errores('password', $errors) }}
	<br/>
	{{ Form::label('password_confirmation', 'Confirmación de Contraseña:') }}
	{{ Form::password('password_confirmation', array('placeholder' => 'oifn230uf23i')) }}
	{{ mostrar_errores('password_confirmation', $errors) }}
	<br/>
	{{ Form::submit('Crear Cuenta') }}
	<br/>
{{ Form::close() }}

@if ( Session::has('error') )
	<span style="font-size: 12px; color: brown;">{{ Session::get('error') }}</span>
@endif
</body>
</html>
