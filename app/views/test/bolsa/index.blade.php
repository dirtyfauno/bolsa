<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Bolsa de Trabajo</title>
</head>
<body>
<br>
{{link_to_route('bolsa.vacantes', 'trabajo practicante', array('practicante'))}} ({{$vacantes_practicantes}} vacantes)
<br>
{{link_to_route('bolsa.vacantes', 'trabajo formal', array('formal'))}} ({{$vacantes_formales}} vacantes)
<br>
@if(Session::has('mensaje'))
<span style="color: brown;">{{ Session::get('mensaje') }}</span>
@endif
{{ Form::open(array('route' => 'ingreso.post')) }}
<br/>
{{ Form::label('email', 'Correo') }}
{{ Form::email('email', null, array('placeholder' => 'mi@correo.com', 'required' => 'required')) }}
{{ mostrar_errores('email', $errors) }}
<br/>
{{ Form::label('password', 'Contraseña:') }}
{{ Form::password('password', array('placeholder' => 'secreta y única', 'required' => 'required')) }}
{{ mostrar_errores('password', $errors) }}
<br/>
{{ Form::submit('Iniciar Sesion') }}
{{ Form::close() }}

{{link_to_route('registro.empresa', 'Registro Empresas')}}
</body>
</html>