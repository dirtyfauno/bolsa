@extends("desktop.masters.bolsa")

@section("vacantes")
<section class="principal clearfix">
    <section class="vacantes clearfix">
        @include("partials/desktop/bolsa/vacantes")
    </section>
</section>
@stop

@section("menu_carreras")
@include("desktop.partials.bolsa.sidebar-keyword")
@stop
