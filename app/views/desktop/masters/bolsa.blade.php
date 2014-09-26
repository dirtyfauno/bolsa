<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">

  <title>{{ $html_title or 'Bolsa de Trabajo: Vacantes' }}</title>
  <link href="http://fonts.googleapis.com/css?family=Muli:300,100,400,400|Josefin+Slab:100,400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/standardize.css">
  <link rel="stylesheet" href="css/index.css">
</head>
<body class="body index clearfix">
<nav class="nav-principal clearfix">
  <div class="contenedor-nav clearfix">
      <h1 class="titulo-pagina">
        {{ $txt_titulo or "Bolsa de Trabajo" }}
      </h1>
      <p class="subtitulo">
        {{ $txt_subtitulo or "Vacantes" }}
      </p>
  </div>
</nav>
<div class="main clearfix">
  <div class="contenido clearfix">
    @yield('vacantes')
    @yield('menu_carreras')
  </div>
</div>

<script src="js/jquery-min.js"></script>
</body>
</html>
