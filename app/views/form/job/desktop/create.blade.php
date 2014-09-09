<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bolsa de Trabajo:</title>
</head>
<body>
<p>asfdasfea</p>
{{ Form::open(array(
    'route'     => 'job.new.post',
    'method'    => 'post'
)) }}

{{ Form::label( 'job-title', 'Título' ) }}
{{ Form::text( 'job-title' ) }}
<br/><br/>
{{ Form::label( 'job-content', 'Contenido' ) }}
{{ Form::textarea( 'job-content' ) }}
<br/><br/>
{{ Form::label('job-place', 'Dónde' ) }}
{{ Form::text( 'job-place' ) }}
<br/><br/>
{{ Form::label( 'job-career', 'Carrera' ) }}
{{ Form::select( 'job-career', $career_list ) }}
<br/><br/>
{{ Form::hidden( 'job-enterprise', $empresa ) }}
{{ Form::submit('Crear nueva Vacante') }}
{{ Form::close() }}
</body>
</html>