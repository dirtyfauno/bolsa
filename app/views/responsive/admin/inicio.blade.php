@extends("masters/responsive/admin")
@section("main")
<h3 class="page-header text-center">
    <span class="label label-danger">{{ $empresas->count() }}</span> Nuevas Empresas Pendientes
</h3>
@include("partials/responsive/admin/inicio-empresas-pendientes")
@stop