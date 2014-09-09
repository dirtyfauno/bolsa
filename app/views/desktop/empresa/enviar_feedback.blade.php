@extends("desktop.masters.empresa")

@section("contenido")

@include("partials.desktop.empresa.menu-info")

<div id="menu-feedback" class="c-menu c-menu-4 clearfix">
  <div class="titulo-menu-1 clearfix">
    <h1 class="titulo">Feedback ó Sugerencias</h1>
  </div>
  <div class="c-formulario clearfix">
    {{ Form::open(array('route' => 'correo.empresa_feedback', 'class' => 'feedback-form clearfix')) }}
	    @if( Session::has('error_feedback') )
	      <span class="error-feedback">{{ Session::get('error_feedback') }}</span>
	    @endif
      <textarea class="feedback-textarea" name="feedback"></textarea>
      {{ Form::submit('Enviar al administrador', array('class' => 'enviar-feedback'))}}
    {{ Form::close() }}
  </div>
</div>
@stop
