<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>{{ $html_title or "Bolsa de Trabajo: Vacante" }}</title>
  <link href="http://fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="/css/standardize.css">
  <link rel="stylesheet" href="/css/vacante.css">
  <style>
    a {
      /* links */
      color: #f2f2f2;
      border-bottom: 1px dotted #f2f2f2;
    }
  </style>
</head>
<body class="body vacante clearfix">
  @yield('vacante')
  <script src="js/jquery-min.js"></script>
</body>
</html>
