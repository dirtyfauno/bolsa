<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin.inicio') }}">
                Administración - Bolsa de Trabajo
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="visible-xs {{ isActive('admin.inicio') }}"><a href="{{ route('admin.inicio') }}">
                        <span class="badge pull-right">{{ $e_pendientes_c }}</span>
                        Nuevas Empresas</a></li>
                <li class="visible-xs {{ isActive('admin.vacantes') }}"><a href="{{ route('admin.vacantes') }}">
                        <span class="badge pull-right">{{ $admin_vacantes_c }}</span>
                        Vacantes</a></li>
                <li class="visible-xs {{ isActive('admin.aplicantes') }}"><a href="{{ route('admin.aplicantes') }}">
                        <span class="badge pull-right">{{ $admin_aplicantes_c }}</span>
                        Aplicantes</a></li>
                <li class="visible-xs {{ isActive('admin.empresas_activas') }}"><a href="{{ route('admin.empresas_activas') }}">
                        <span class="badge pull-right">{{ $e_activas_c }}</span>
                        Empresas</a></li>
                <li class="visible-xs {{ isActive('admin.aplicantes_desactivados') }}"><a href="{{ route('admin.aplicantes_desactivados') }}">
                        <span class="badge pull-right">{{ $a_desactivados_c }}</span>
                        Aplicantes Desactivados</a></li>
                <li class="visible-xs {{ isActive('admin.empresas_desactivadas') }}"><a href="{{ route('admin.empresas_desactivadas') }}">
                        <span class="badge pull-right">{{ $e_desactivadas_c }}</span>
                        Empresas Desactivadas</a></li>
                <li><a href="{{ route('session.destroy') }}">Salir</a></li>
            </ul>
        </div>
    </div>
</div>