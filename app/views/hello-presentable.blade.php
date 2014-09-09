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
    @foreach($vacantes as $job)
    <h2>tittulo:</h2>
    <p>{{ $job->present()->content }}</p>
    @endforeach
</ul>

</body>
</html>