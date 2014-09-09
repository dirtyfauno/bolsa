@extends("masters/responsive/admin")
@section("main")
    <h3 class="page-header text-center">
        <span class="label label-danger">{{ $vacantes_c }}</span> Vacantes Actuales
    </h3>
    @include("partials/responsive/admin/vacantes_actuales_table")
@stop