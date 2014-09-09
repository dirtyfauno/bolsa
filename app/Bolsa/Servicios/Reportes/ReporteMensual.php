<?php namespace Bolsa\Reportes;

use Carbon\Carbon;
use DB;
use Log;

/**
 * Class ReporteMensual
 * @package Bolsa\Reportes
 */
class ReporteMensual {

    /**
     * @var ReporteQueries
     */
    protected $query;
    /**
     * @var ReporteFechas
     */
    protected $fechas;
    /**
     * @var int
     */
    protected $carreraID;

    protected $carreras = array();

    /**
     * @param ReporteFechas  $fechas
     * @param ReporteQueries $qr
     */
    public function __construct(ReporteFechas $fechas, ReporteQueries $qr)
    {
        $this->query = $qr;
        $this->fechas = $fechas;
    }

    /**
     * @param array $carreras_arr
     */
    public function setCarreras(array $carreras_arr)
    {
        $this->carreras = $carreras_arr;
        return $this;
    }

    /**
     * @param \Bolsa\Reportes\ReporteFechas $fechas
     */
    public function setFechas(ReporteFechas $fechas)
    {
        $this->fechas = $fechas;
        return $this;
    }

    /**
     * @param $nombre
     *
     * @return $this
     */
    public function tabla($nombre)
    {
        $this->setTabla($nombre);

        return $this;
    }

    /**
     * @return int
     */
    public function totales()
    {
        $resultado = $this->query->obtener_totales();

        return $resultado;
    }

    /**
     * @return int
     */
    public function totales_oferta()
    {
        $resultado = $this->query->obtener_avg_totales_oferta();

        return $resultado;
    }

    /**
     * @return int
     */
    public function formal()
    {
        $resultado = $this->query->obtenerVacantesFormales();

        return $resultado;
    }

    /**
     * @return int
     */
    public function formal_oferta()
    {
        $resultado = $this->query->obtener_avg_vacantes_formales_oferta();

        return $resultado;
    }

    /**
     * @return int
     */
    public function practicas()
    {
        $resultado = $this->query->obtenerVacantesPracticantes();

        return $resultado;
    }

    /**
     * @return int
     */
    public function practicas_oferta()
    {
        $resultado = $this->query->obtener_avg_vacantes_practicante_oferta();
        return $resultado;
    }

    /**
     * @return int
     */
    public function no_ingles_formal()
    {
        $resultado = $this->query->no_ingles_formal_total();
        return $resultado;
    }

    /**
     * @return int
     */
    public function no_ingles_formal_oferta()
    {
        $resultado = $this->query->no_ingles_formal_oferta();
        return $resultado;
    }

    /**
     * @return int
     */
    public function no_ingles_practicas()
    {
        $resultado = $this->query->no_ingles_practicas_total();
        return $resultado;
    }

    /**
     * @return int
     */
    public function no_ingles_practicas_oferta()
    {
        $resultado = $this->query->no_ingles_practicas_oferta();
        return $resultado;
    }

    /**
     * @return int
     */
    public function ingles_formal()
    {
        return $this->query->obtener_vacantes_formal_ingles_total();
    }

    /**
     * @return int
     */
    public function ingles_formal_oferta()
    {
        return $this->query->obtener_avg_vacantes_formal_ingles_oferta();
    }

    /**
     * @return int
     */
    public function ingles_basico_formal()
    {
        return $this->query->ingles_basico_formal_total();
    }

    /**
     * @return int
     */
    public function ingles_basico_formal_oferta()
    {
        return $this->query->ingles_basico_formal_oferta();
    }

    /**
     * @return int
     */
    public function ingles_intermedio_formal()
    {
        return $this->query->ingles_intermedio_formal_total();
    }

    /**
     * @return int
     */
    public function ingles_intermedio_formal_oferta()
    {
        return $this->query->ingles_intermedio_formal_oferta();
    }

    /**
     * @return int
     */
    public function ingles_avanzado_formal()
    {
        return $this->query->ingles_avanzado_formal_total();
    }

    /**
     * @return int
     */
    public function ingles_avanzado_formal_oferta()
    {
        return $this->query->ingles_avanzado_formal_oferta();
    }

    /**
     * @return int
     */
    public function ingles_practicas()
    {
        return $this->query->ingles_practicas_total();
    }

    /**
     * @return int
     */
    public function ingles_practicas_oferta()
    {
        return $this->query->ingles_practicas_oferta();
    }

    /**
     * @return int
     */
    public function ingles_basico_practicas()
    {
        return $this->query->ingles_basico_practicas_total();
    }

    /**
     * @return int
     */
    public function ingles_basico_practicas_oferta()
    {
        return $this->query->ingles_basico_practicas_oferta();
    }

    /**
     * @return int
     */
    public function ingles_intermedio_practicas()
    {
        return $this->query->ingles_intermedio_practicas_total();
    }

    /**
     * @return int
     */
    public function ingles_intermedio_practicas_oferta()
    {
        return $this->query->ingles_intermedio_practicas_oferta();
    }

    /**
     * @return int
     */
    public function ingles_avanzado_practicas()
    {
        return $this->query->ingles_avanzado_practicas_total();
    }

    /**
     * @return int
     */
    public function ingles_avanzado_practicas_oferta()
    {
        return $this->query->ingles_avanzado_practicas_oferta();
    }

    /**
     * @return string
     */
    public function programas()
    {
        return $this->query->programasJSON();
    }

    /**
     * @param $carrera_string
     *
     * @return int
     * @throws \Exception
     */
    protected function obtenerCarreraId($carrera_string)
    {
        $id = $this->getId($carrera_string);

        if (! is_int($id))
        {
            throw new \Exception("la carrera no existes en la base de datos");
        }

        return $id;
    }

    /**
     *
     */
    public function actualizar()
    {
        $start_time = microtime(true);

        Log::debug("\n#####################################\n" . "#  BEGIN bolsa:actualizar-reporte   #\n" . "#  inicio: {$this->fechas->getMesInicio()}      #\n" . "#  fin:    {$this->fechas->getMesFin()}      #\n" . "#####################################\n");

        $carreras = $this->carreras;

        // agregar 'general' para actualizar la tabla general también
        $carreras[] = 'general';

        foreach ($carreras as $carrera)
        {
            Log::debug("bolsa:actualizar-reporte - {$carrera}");

            $reporte = array(
                'mes'                                => (int) $this->fechas->getMesInicio()->month,
                'year'                               => (int) $this->fechas->getMesInicio()->year,
                'total'                              => $this->tabla($carrera)->totales(),
                'total_oferta'                       => $this->tabla($carrera)->totales_oferta(),
                'formal_total'                       => $this->tabla($carrera)->formal(),
                'formal_oferta'                      => $this->tabla($carrera)->formal_oferta(),
                'practicas_total'                    => $this->tabla($carrera)->practicas(),
                'practicas_oferta'                   => $this->tabla($carrera)->practicas_oferta(),
                'no_ingles_formal_total'             => $this->tabla($carrera)->no_ingles_formal(),
                'no_ingles_formal_oferta'            => $this->tabla($carrera)->no_ingles_formal_oferta(),
                'no_ingles_practicas_total'          => $this->tabla($carrera)->no_ingles_practicas(),
                'no_ingles_practicas_oferta'         => $this->tabla($carrera)->no_ingles_practicas_oferta(),
                'ingles_formal_total'                => $this->tabla($carrera)->ingles_formal(),
                'ingles_formal_oferta'               => $this->tabla($carrera)->ingles_formal_oferta(),
                'ingles_formal_basico_total'         => $this->tabla($carrera)->ingles_basico_formal(),
                'ingles_formal_basico_oferta'        => $this->tabla($carrera)->ingles_basico_formal_oferta(),
                'ingles_formal_intermedio_total'     => $this->tabla($carrera)->ingles_intermedio_formal(),
                'ingles_formal_intermedio_oferta'    => $this->tabla($carrera)->ingles_intermedio_formal_oferta(),
                'ingles_formal_avanzado_total'       => $this->tabla($carrera)->ingles_avanzado_formal(),
                'ingles_formal_avanzado_oferta'      => $this->tabla($carrera)->ingles_avanzado_formal_oferta(),
                'ingles_practicas_total'             => $this->tabla($carrera)->ingles_practicas(),
                'ingles_practicas_oferta'            => $this->tabla($carrera)->ingles_practicas_oferta(),
                'ingles_practicas_basico_total'      => $this->tabla($carrera)->ingles_basico_practicas(),
                'ingles_practicas_basico_oferta'     => $this->tabla($carrera)->ingles_basico_practicas_oferta(),
                'ingles_practicas_intermedio_total'  => $this->tabla($carrera)->ingles_intermedio_practicas(),
                'ingles_practicas_intermedio_oferta' => $this->tabla($carrera)->ingles_intermedio_practicas_oferta(),
                'ingles_practicas_avanzado_total'    => $this->tabla($carrera)->ingles_avanzado_practicas(),
                'ingles_practicas_avanzado_oferta'   => $this->tabla($carrera)->ingles_avanzado_practicas_oferta(),
                'programas'                          => $this->tabla($carrera)->programas(),
                'created_at'                         => Carbon::now('America/Mexico_city'),
                'updated_at'                         => Carbon::now('America/Mexico_city')
            );

            // actualizar db de reportes
            DB::connection('reportes')->table($carrera)->insert($reporte);
        }

        $end_time = microtime(true);

        $time = $end_time - $start_time;

        Log::debug("\n#####################################\n" . "#   END bolsa:actualizar-reporte    #\n" . "#   time: {$time} seg      #\n" . "####################################\n");
    }

    /**
     * @param $carrera_string
     *
     * @return int
     */
    protected function getId($carrera_string)
    {
        $id = (int) array_search($carrera_string, (array) $this->carreras);
        return $id;
    }

    /**
     * @param $nombre
     */
    protected function setTabla($nombre)
    {
        if ($nombre == 'general')
        {
            $this->query->tabla($this->fechas->getArrayRango());
        }

        $carreraId = $this->obtenerCarreraId($nombre);

        $this->query->tabla($this->fechas->getArrayRango(), $carreraId);
    }
}
