<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    <h2>Bolsa de Trabajo</h2>
    <p>
        Te informamos que tu cuenta ha sido activada.
    </p>
    <p>
        Para iniciar sesión ingresar al siguiente <a href="{{ route('bolsa.inicio') }}">enlace</a>.
    </p>
</div>
<br>
<h5>
    {{ \Carbon\Carbon::now()->formatLocalized('%A %d %B del %Y') }}
</h5>
</body>
</html>
