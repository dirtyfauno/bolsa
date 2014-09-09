@extends("desktop.masters.inicio")

@section("contenido")
<div id="login-zorros" class="c-opciones c-opciones-2 clearfix">
  <form method="post" class="inicio-zorros clearfix">
    <div class="c-inputs clearfix">
      <div class="c-correo clearfix">
        <input class="correo" name="correo" placeholder="Número de Control" type="text">
      </div>
      <div class="c-password clearfix">
        <input class="password" name="password" placeholder="NIP" type="password">
      </div>
    </div>
    <button class="btn-alta">Dar de Alta</button>
  </form>
</div>
@stop
