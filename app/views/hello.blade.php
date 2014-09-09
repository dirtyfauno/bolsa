<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bolsa de Trabajo</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
<ul>
    @foreach($vacantes->getItems() as $job)
    <h1>id: {{ $job->id }} => {{ $job->present()->id }}</h1>
    <h2>tittulo: {{ $job->titulo }}</h2>
    <li>contenido: {{ $job->contenido }}</li>
    @endforeach
</ul>

{{ $vacantes->links() }}
</body>
</html>