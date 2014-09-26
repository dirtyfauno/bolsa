<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>{{ $html_title or "Bolsa de Trabajo: Vacante" }}</title>
  <link href="//fonts.googleapis.com/css?family=Muli:300,400" rel="stylesheet" type="text/css">
  {{ HTML::style('css/standardize.css') }}
  {{ HTML::style('css/vacante.css') }}
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
{{ HTML::script('js/jquery-min.js') }}
</body>
</html>
