@if(Session::has("mensaje"))
    <p class="alerta-verde">{{ Session::get("mensaje") }}</p>
@elseif(Session::has("alerta"))
    <p class="alerta-roja">{{ Session::get("alerta") }}</p>
@elseif(Session::has("admin"))
    <p class="alerta-roja">{{ Session::get("admin") }}</p>
@endif