<?php namespace Bolsa\Laravel\Providers;

use Bolsa\CLI\ActualizarReporte;
use Bolsa\ObtenerVacantes;
use Bolsa\Reportes\ReporteQueries;
use Bolsa\Reportes\ReporteMensual;
use Bolsa\Reportes\ReporteFechas;
use Bolsa\Repositorios\JobRepository;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use VacanteModel;

/**
 * Class FacadesServiceProvider
 * @package Bolsa\Laravel\Providers
 */
class FacadesServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("Bolsa\\CLI\\ActualizarReporte", function ()
        {
            // fecha de inicio del mes pasado
            $inicio_del_mes = Carbon::now('America/Mexico_city')->subMonth()->firstOfMonth();

            // fecha del final del mes pasado
            $fin_del_mes = Carbon::now('America/Mexico_city')->subMonth()->endOfMonth();

            $fechas = new ReporteFechas($inicio_del_mes, $fin_del_mes);

            $reporte = new ReporteMensual($fechas, new ReporteQueries);

            return new ActualizarReporte($reporte);
        });

        $this->app->bind("job-repository", function ()
        {
            return new JobRepository(new VacanteModel);
        });

        $this->app->bind("bolsa.obtener-vacantes", function ()
        {
            return new ObtenerVacantes(app("job-repository"));
        });
    }
}