<?php namespace Bolsa\CLI;

use Bolsa\Reportes\ReporteFechas;
use Bolsa\Reportes\ReporteMensual;
use Bolsa\Reportes\ReporteQueries;
use Carbon\Carbon;
use CarreraModel;
use DB;
use Exception;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ActualizarReporte
 * @package Bolsa\CLI
 */
class ActualizarReporte extends ScheduledCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bolsa:actualizar-reporte';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza la base de datos de estadísticas.';

    /**
     * @var \Bolsa\Reportes\ReporteMensual
     */
    protected $reporteMensual;

    /**
     * @var int
     */
    protected $meses = 1;

    /**
     * Create a new command instance.
     *
     * @param ReporteMensual $reporte
     * @return \Bolsa\CLI\ActualizarReporte
     */
    public function __construct(ReporteMensual $reporte)
    {
        parent::__construct();

        $this->reporteMensual = $reporte;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->meses = (int) $this->option("meses");

        $this->init();

        $this->actualizarReporte($this->meses);

        $this->info("Reporte Actualizado");
    }

    /**
     * @param $meses
     */
    private function actualizarReporte($meses)
    {
//        echo "\nmeses a reportar: {$meses}\n";

        foreach (range(1, $meses) as $mes)
        {
//            echo "\nmes: {$mes}\n";

            /** @var Carbon $inicioMes */
            $inicioMes = Carbon::now('America/Mexico_city')->subMonths($mes)->firstOfMonth();

            /** @var Carbon $finMes */
            $finMes = Carbon::now('America/Mexico_city')->subMonths($mes)->endOfMonth();

            $this->info("Reporte Creado del \"día {$inicioMes->day} mes {$inicioMes->month} año {$inicioMes->year}\" al día \"{$finMes->day} mes {$finMes->month} año {$finMes->year}\"");

            $this->reporteMensual->setFechas(new ReporteFechas($inicioMes, $finMes));

            $this->reporteMensual->actualizar();
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function obtener_columnas_de_tabla_vacantes()
    {
        $db = DB::getDoctrineSchemaManager();

        $tablaVacantes = "vacantes";

        $columnas = $db->listTableColumns($tablaVacantes);

        if (empty($columnas))
        {
            throw new Exception("tabla \"{$tablaVacantes}\" - no existe en la base de datos");
        }

        return array($tablaVacantes, $columnas);
    }

    /**
     * @param $tabla_columnas
     * @param $tabla
     *
     * @throws \Exception
     */
    private function verificar_columnas_de_tabla_vacantes($tabla_columnas, $tabla)
    {
        $columnas = array(
            ReporteQueries::CARRERA_ID,
            ReporteQueries::NIVEL_INGLES,
            ReporteQueries::OFERTA,
            ReporteQueries::TIPO_VACANTE,
        );

        foreach ($columnas as $columna)
        {
            if (! array_key_exists($columna, $tabla_columnas))
            {
                throw new Exception("columna \"{$columna}\" en tabla \"{$tabla}\" no existe ó ha sido moficada");
            }
        }
    }

    /**
     *
     */
    private function init()
    {
        $this->reporteMensual->setCarreras(CarreraModel::lists("slug", "id"));

        list($tablaVacantes, $columnas) = $this->obtener_columnas_de_tabla_vacantes();

        $this->verificar_columnas_de_tabla_vacantes($columnas, $tablaVacantes);
    }

    /**
     * When a command should run
     *
     * @param Scheduler|Schedulable $scheduler
     *
     * @return \Indatus\Dispatcher\Scheduling\Schedulable|\Indatus\Dispatcher\Scheduling\Schedulable[]
     */
    public function schedule(Schedulable $scheduler)
    {
        return $scheduler->monthly();
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array("meses", null, InputOption::VALUE_OPTIONAL, "Número de meses que creará reporte", 1)
        );
    }
}
