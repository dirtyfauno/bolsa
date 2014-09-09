<!doctype html>
<html>
    
<head>
	        
	<meta charset="utf-8">
	<title>Bolsa de Trabajo: Editando Vacante</title>
	        
	<link rel="stylesheet"
	      href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ url('editor/css/medium-editor.css') }}">
	<link rel="stylesheet" href="{{ url('editor/css/themes/default.css') }}">
	<link rel="stylesheet"
	      href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
	<style>
		table form {
			margin-bottom: 0;
		}

		form ul {
			margin-left: 0;
			list-style: none;
		}

		.error {
			color: red;
			font-style: italic;
		}

		body {
			padding-top: 20px;
		}
	</style>
	        
	<style>
		table form {
			margin-bottom: 0;
		}

		form ul {
			margin-left: 0;
			list-style: none;
		}

		.error {
			color: red;
			font-style: italic;
		}

		body {
			padding-top: 20px;
		}

		#success-mensaje {
			position: fixed;
			bottom: 12%;
			/*right: 20px;*/
			z-index: 10000;
		}
	</style>
	    
</head>
 
    
<body>
 
        
<div class="container">
	@if (Session::has('message'))                  
	<div class="flash alert">
		<p>{{ Session::get('message') }}</p>                 
	</div>
	@endif
	<div id="error-mensaje" style="display: none;" class="error alert alert-danger"></div>
	<div id="success-mensaje" style="display: none;"
	     class="success alert alert-success"></div>

	{{ Form::open(array('route' => 'vacante.actualizar')) }}
	{{ Form::label('correo', 'Correo') }}
	{{ Form::text('correo', $vacante->present()->correo, array('id'=> 'correo',
	'placeholder' =>
	'reclutamiento@empresa.com', 'required' => 'required')) }}
	<span class="err" style="color: brown;" id="correo">no hay error</span>
	<br/>
	{{ Form::label('carrera_id', 'Carrera') }}
	{{ Form::select('carrera_id', $carreras_lista, $vacante->present()->carrera_id,
	array('id'=> 'carrera_id',
	'required' => 'required')) }}
	<span class="err" style="color: brown;" id="carrera_id">no hay error</span>
	<br/>
	{{ Form::label('tipo_sueldo', 'Tipo de Sueldo') }}
	{{ Form::select('tipo_sueldo', $sueldos_lista, $vacante->present()->tipo_sueldo_id,
	array('id'=> 'tipo_sueldo',
	'required' => 'required')) }}
	<span class="err" style="color: brown;" id="tipo_sueldo">no hay error</span>
	<br/>
	{{ Form::label('tipo_vacante', 'Tipo de Trabajo') }}
	{{ Form::select('tipo_vacante', $tipos_lista, $vacante->present()->tipo_vacante_id,
	array('id'=> 'tipo_vacante',
	'required' => 'required')) }}
	<span class="err" style="color: brown;" id="tipo_vacante">no hay error</span>
	<br/>
	{{ Form::label('tipo_prestacion', 'Prestaciones') }}
	{{ Form::select('tipo_prestacion', $prestaciones_lista,
	$vacante->present()->tipo_prestacion, array('id'=>
	'tipo_prestacion', 'required' =>
	'required')) }}
	<span class="err" style="color: brown;" id="tipo_prestacion">no hay error</span>
	<br/>
	{{ Form::label('tipo_estancia', 'Tipo de Estancia') }}
	{{ Form::select('tipo_estancia', $estancias_lista,
	$vacante->present()->tipo_estancia_id,
	array('id'=> 'tipo_estancia',
	'required' =>
	'required')) }}
	<span class="err" style="color: brown;" id="tipo_estancia">no hay error</span>
	<br/>
	{{ Form::label('nivel_ingles', 'Nivel de Inglés') }}
	{{ Form::select('nivel_ingles', $ingles_lista, $vacante->present()->nivel_ingles_id,
	array('id'=> 'nivel_ingles',
	'required' => 'required')) }}
	<span class="err" style="color: brown;" id="nivel_ingles">no hay error</span>
	<br/>
	{{ Form::label('oferta', 'Sueldo') }}
	{{ Form::text('oferta', $vacante->present()->oferta_entero, array('id'=> 'oferta',
	'placeholder' => 'sólo
	números',
	'required' => 'required')) }}
	<span class="err" style="color: brown;" id="oferta">no hay error</span>
	<br/>
	{{ Form::label('keyword2', 'Habilidad Técnica 2') }}
	{{ Form::text('keyword2', $vacante->present()->keyword2, array('id'=> 'keyword2',
	'placeholder' => 'ejemplos:
	Algún Software, Algún
	Lenguaje de programación, etc.', 'required' => 'required')) }}
	<span class="err" style="color: brown;" id="keyword2">no hay error</span>
	<br/>
	{{ Form::label('keyword1', 'Habilidad Técnica 1') }}
	{{ Form::text('keyword1', $vacante->present()->keyword1, array('id'=> 'keyword1',
	'placeholder' => "ejemplos:
	Excel, Office, Autocad, Java, etc.", 'required' => 'required')) }}
	<span class="err" style="color: brown;" id="keyword1">no hay error</span>
	<br/>
	<span class="err" style="color: brown;" id="titulo">no hay error</span>

	<div class="title-editable" id="vacante-titulo"><h1>{{ $vacante->present()->titulo
			}}</h1>
	</div>
	<span class="err" style="color: brown;" id="contenido">no hay error</span>

	<div class="body-editable" id="vacante-contenido">{{ $vacante->present()->contenido }}
	</div>
	{{ Form::submit('Actualizar Vacante', array('class' => 'btn btn-primary', 'id' =>
	'form-update'))
	}}
	{{ Form::close() }}
	  
</div>
<script
		src="//cdnjs.cloudflare.com/ajax/libs/classlist/2014.01.31/classList.min.js"></script>
<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
<script src="{{ url('editor/js/medium-editor.js') }}"></script>
<script>
	jQuery.fn.center = function (parent) {
		if (parent) {
			parent = this.parent();
		} else {
			parent = window;
		}

		console.log(parent)
		this.css({
			"left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
		});
		return this;
	};
	// initializing editors
	var titleEditor = new MediumEditor('.title-editable', {
		buttonLabels: 'fontawesome'
	});

	var bodyEditor = new MediumEditor('.body-editable', {
		anchorInputPlaceholder: 'Type a link',
		buttons: ['bold', 'italic', 'quote'],
//		diffLeft: 25,
//		diffTop: 10,
		firstHeader: 'h1',
		secondHeader: 'h2',
		delay: 222,
		targetBlank: true
	});
	$(function () {
		// initializing insert image on body editor
//		$('.body-editable').mediumInsert({
//			editor: bodyEditor,
//			images: true,
//			imagesUploadScript: "{{ URL::to('upload') }}"
//		});
		// deactivate editors on show view
		if ($('#hideEditor').length) {
			$('.body-editable').mediumInsert('disable');
//			bodyEditor.deactivate();
			titleEditor.deactivate();
		}
	});
	// hiding messages
	//	$('.error').hide().empty();
	//	$('.success').hide().empty();

	// create post
	$('body').on('click', '#form-submit', function (e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: "{{ route('vacante.nueva') }}",
			data: {
				correo: $("#correo").val(),
				carrera_id: $("#carrera_id").val(),
				tipo_sueldo: $("#tipo_sueldo").val(),
				tipo_prestacion: $("#tipo_prestacion").val(),
				tipo_vacante: $("#tipo_vacante").val(),
				tipo_estancia: $("#tipo_estancia").val(),
				nivel_ingles: $("#nivel_ingles").val(),
				oferta: $("#oferta").val(),
				keyword1: $("#keyword1").val(),
				keyword2: $("#keyword2").val(),
				titulo: $("#vacante-titulo").text(),
				contenido: $("#vacante-contenido").html() },
			success: function (data) {
				if (data.success === false) {
					$('#error-mensaje').text(data.message);
					$('#error-mensaje').show();

					$(".err").map(function (index, el) {
						$(el).text("no hay");
					});

					$.each(data.errors, function (key, value) {
						$("span#" + key).text(value[0]);
					});

				} else {
					$('.success').text(data.message);
					$("#success-mensaje").center(false);
					$("#success-mensaje").slideDown(800, function () {
						window.location.href = "{{ route('empresa.inicio') }}";
					});
				}
			},
			error: function (xhr, textStatus, thrownError) {
				alert('Falló la conexión');
			}
		});
		return false;
	});

	// update post
	$('body').on('click', '#form-update', function (e) {
		e.preventDefault();
		var postTitle = titleEditor.serialize();
		var postContent = bodyEditor.serialize();

		$.ajax({
			type: 'PUT',
			dataType: 'json',
			url: "{{ route('vacante.actualizar', array($vacante->present()->id)) }}",
			data: {
				correo: $("#correo").val(),
				carrera_id: $("#carrera_id").val(),
				tipo_sueldo: $("#tipo_sueldo").val(),
				tipo_prestacion: $("#tipo_prestacion").val(),
				tipo_vacante: $("#tipo_vacante").val(),
				tipo_estancia: $("#tipo_estancia").val(),
				nivel_ingles: $("#nivel_ingles").val(),
				oferta: $("#oferta").val(),
				keyword1: $("#keyword1").val(),
				keyword2: $("#keyword2").val(),
				titulo: $("#vacante-titulo").text(),
				contenido: $("#vacante-contenido").html() },
			success: function (data) {
				if (data.success === false) {
					$('#error-mensaje').text(data.message);
					$('#error-mensaje').show();

					$(".err").map(function (index, el) {
						$(el).text("no hay");
					});

					$.each(data.errors, function (key, value) {
						$("span#" + key).text(value[0]);
					});
				} else {
					$('.success').text(data.message);
					$("#success-mensaje").center(false);
					$("#success-mensaje").slideDown(800, function () {
						window.location.href = "{{ route('empresa.inicio') }}";
					});

				}
			},
			error: function (xhr, textStatus, thrownError) {
				alert('Falló la conexión');
			}
		});
		return false;
	});
</script>
</body>
 
</html>