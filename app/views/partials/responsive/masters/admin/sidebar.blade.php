<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-stacked nav-pills nav-sidebar">
        <li class="{{ isActive('admin.inicio') }}"><a href="{{ route('admin.inicio') }}">
                <span class="badge pull-right">{{ $e_pendientes_c }}</span>
                Nuevas Empresas</a></li>
        <li><a target="_blank" href="{{ route('estadisticas') }}">
                Estadísticas</a></li>
        <li class="{{ isActive('admin.vacantes') }}"><a href="{{ route('admin.vacantes') }}">
                <span class="badge pull-right">{{ $admin_vacantes_c }}</span>
                Vacantes</a></li>
        <li class="{{ isActive('admin.aplicantes') }}"><a href="{{ route('admin.aplicantes') }}">
                <span class="badge pull-right">{{ $admin_aplicantes_c }}</span>
                Aplicantes</a></li>
        <li class="{{ isActive('admin.empresas_activas') }}"><a href="{{ route('admin.empresas_activas') }}">
                <span class="badge pull-right">{{ $e_activas_c }}</span>
                Empresas</a></li>
        <li class="{{ isActive('admin.aplicantes_desactivados') }}"><a href="{{ route('admin.aplicantes_desactivados') }}">
                <span class="badge pull-right">{{ $a_desactivados_c }}</span>
                Aplicantes Desactivados</a></li>
        <li class="{{ isActive('admin.empresas_desactivadas') }}"><a href="{{ route('admin.empresas_desactivadas') }}">
                <span class="badge pull-right">{{ $e_desactivadas_c }}</span>
                Empresas Desactivadas</a></li>
        @if($isGeneralAdmin)
        <li class="{{ isActive('admin.nuevo') }}"><a href="{{ route('admin.nuevo') }}">
                <span class="badge pull-right">{{ $admin_activos }}</span>
                Crear Admin</a></li>
        <li class="{{ isActive('admin.desactivados') }}"><a href="{{ route('admin.desactivados') }}">
                <span class="badge pull-right">{{ $admin_desactivados }}</span>
                Admin Desactivados</a></li>
        @endif
    </ul>
</div>