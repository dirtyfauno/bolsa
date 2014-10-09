<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>home</title>
  <link href="//fonts.googleapis.com/css?family=Muli:300|Josefin+Slab:400" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/standardize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body class="body home clearfix">
  <div class="c-nav clearfix">
    <img class="logo" src="{{ asset('images/logo_ITQ_original-120x131.png') }}" data-rimage data-src="{{ asset('images/logo_ITQ_original-120x131.png') }}">
  </div>
  <div class="c-main clearfix">
    <p class="titulo">Bolsa de Trabajo del Instituto Tecnológico de Querétaro</p>

    <div class="c-opciones c-opciones-2 clearfix">
      {{ Form::open() }}
        <div class="c-inputs clearfix">
          <div class="c-correo clearfix">
            <input class="correo" name="email" placeholder="Correo" type="text">
            @if ( Session::has('error') )
              <span style="font-size: 12px; color: #ffffff;">{{ Session::get('error') }}</span>
            @elseif ( Session::has('status') )
              <span>{{ Session::get('status') }}</span>
            @endif
            {{ mostrar_errores('email', $errors, '#f2f2f2') }}
          </div>
        </div>
        {{ Form::submit('Reset', array('class' => 'submit')) }}
      {{ Form::close() }}
    </div>
  </div>

  <script src="{{ asset('js/jquery-min.js') }}"></script>
  <script src="{{ asset('js/rimages.js') }}"></script>
</body>
</html>
