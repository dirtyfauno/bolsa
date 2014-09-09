<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0">

	<title>Bolsa de Trabajo: Vacantes</title>
	<link
			href="http://fonts.googleapis.com/css?family=Muli:300,400,400|Josefin+Slab:100,700"
			rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="/css/standardize.css">
	<link rel="stylesheet" href="/css/index-grid.css">
	<link rel="stylesheet" href="/css/index.css">
</head>
<body class="body index clearfix">
<nav class="nav-principal clearfix">
	<div class="contenedor-nav clearfix">
		<div class="titulo-contenedor clearfix">
			<h1 class="titulo-pagina">VACANTES de {{$empresa}} ({{$vacantes_totales}})</h1>

			<h2>TRABAJO {{$vacantes_tipo}}&nbsp;</h2>
		</div>
		<!--		todo: cambiar a input-->
		<button class="btn-registro" type="button">REGISTRAR</button>
	</div>
</nav>
<div class="main clearfix">
	<div class="contenido clearfix">
		<section class="principal clearfix">
			<section class="vacantes clearfix">
				@foreach( $vacantes as $indice => $trabajo )
				<a class="vacante1 clearfix"
				   href="{{ URL::route('bolsa.vacante', array(
				            $vacantes_tipo,
				            $trabajo->present()->id,
                    $trabajo->present()->tituloSlug)) }}">
					<div class="vacante-info clearfix">
						<h2 class="titulo" style="color: black;">
							{{$trabajo->present()->titulo }}</h2>

						<div class="oferta-sueldo-horario">{{
							$trabajo->present()->oferta }} -
							Honorarios/Comisión
							- Tiempo Completo
						</div>
						<span style="color: #f5f5f5">
							{{$trabajo->present()->tipo}}
						</span>

						<div class="carrera-fecha">{{
							$trabajo->present()->carrera }},&nbsp;{{
							$trabajo->present()->fecha }}
						</div>
					</div>
				</a>
				@endforeach
				{{ $vacantes->links() }}
			</section>
		</section>
		<!--		 ASIDE: LICENCIATURAS-->
		<aside class="carreras clearfix">
			<a class="carrera-general" type="button" href="#">General</a>
			@foreach( $carreras as $licenciatura )
			@if($licenciatura->total > 0)
			<a class="carrera" type="button"
			   href="{{ URL::route('bolsa.carrera.empresa', array(
			    $vacantes_tipo,
			    $empresa,
			    $licenciatura->slug)) }}">
				{{ $licenciatura->nombre }} ({{$licenciatura->total}})
			</a>
			@endif
			@endforeach
		</aside>
	</div>
</div>

<script src="/js/jquery-min.js"></script>
</body>
</html>