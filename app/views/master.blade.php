<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Bolsa de Trabajo</title>
    <!--  estilo -->
    @include('partials.estilo')
	<style>
		h1 {
			color: #000000;
		}
		h2 {
			color: #000000;
		}
	</style>
</head>
<body class="body index clearfix">
<!-- navegacion -->
@include('partials.navegacion')
<!-- main -->
<div class="main clearfix">
    @yield('contenido')
</div>
<!-- librerias -->
@include('partials.librerias')
</body>
</html>
