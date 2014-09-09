<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    <h2>Bolsa de Trabajo</h2>
    <p>
        Admin, cuenta ha sido activada.
    </p>
    <p>
        Para crear una nueva contraseña ir a este <a href="{{ url('password/remind') }}">enlace</a>.
    </p>
</div>
<br>
<h5>
    {{ \Carbon\Carbon::now()->formatLocalized('%A %d %B del %Y') }}
</h5>
</body>
</html>
