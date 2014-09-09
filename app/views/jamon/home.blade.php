<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">

    <title>Bolsa de Trabajo</title>
    <link href="http://fonts.googleapis.com/css?family=Muli:400,300,400|Josefin+Slab:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/standardize.css">
    <link rel="stylesheet" href="/css/index-grid.css">
    <link rel="stylesheet" href="/css/index.css">
</head>
<body class="body index clearfix">
<nav class="_container _container-1">
    <button class="_button" type="button">REGISTRAR</button>
</nav>
<div class="main clearfix">
    <!-- MAIN: VACANTES -->
    <section class="vacantes clearfix">
        @foreach( $vacantes as $i => $trabajo )
        <a class="vacante-{{ ++$i }} clearfix"
           href="{{ URL::route('bolsa.vacante', array(
                    $trabajo->present()->carreraSlug,
                    $trabajo->present()->id,
                    $trabajo->present()->tituloSlug)) }}">
            <h2 class="titulo">
                {{ $trabajo->present()->titulo }}
            </h2>
            <div class="carrera">
                {{ $trabajo->present()->carrera }}
            </div>
            <div class="oferta">
                {{ $trabajo->present()->oferta }}
            </div>
            <section class="etiquetas clearfix">
                <div class="etiqueta">
                    {{ $trabajo->keyword1 }}
                </div>
                <div class="etiqueta">
                    {{ $trabajo->keyword2 }}
                </div>
            </section>
            <div class="fecha">
                {{ $trabajo->present()->fecha }}
            </div>
        </a>
        @endforeach
    </section>
    <!-- ASIDE: LICENCIATURAS -->
    <aside class="menu-seleccion clearfix">
        <label class="_text _text-2">CARRERAS:</label>
        <ul class="licenciaturas clearfix">
            @foreach( $carreras as $licenciatura )
            <li class="licenciatura clearfix">
                <a class="_text"
                   href="{{ URL::route('bolsa.carrera', $licenciatura->slug) }}">
                    {{ $licenciatura->nombre }}
                </a>
            </li>
            @endforeach
        </ul>
    </aside>
    {{ $vacantes->links() }}
</div>

<script src="/js/jquery-min.js"></script>
</body>
</html>