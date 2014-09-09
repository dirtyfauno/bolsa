<?php

namespace Bolsa\Servicios;

use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Support\Collection;
use Log;

/**
 * Class EstadisticasVacantes
 * @package Bolsa\Servicios
 */
class EstadisticasVacantes {

    /**
     * @var Log
     */
    protected $log;

    /**
     * @param array $carreras
     */
    public function __construct(array $carreras, $log)
    {
        $this->carreras = $carreras;

        $this->log = $log;
    }

    /**
     * @var
     */
    protected $estadisticas;
    /**
     * @var
     */
    protected $rangoMeses;
    /**
     *
     */
    const TAB_GENERAL = "general";
    /**
     *
     */
    const COL_TOTAL = "total";
    /**
     *
     */
    const COL_TOTAL_OFERTA = "total_oferta";
    /**
     *
     */
    const COL_FORMAL_TOTAL = "formal_total";
    /**
     *
     */
    const COL_FORMAL_OFERTA = "formal_oferta";
    /**
     *
     */
    const COL_PRACTICAS_TOTAL = "practicas_total";
    /**
     *
     */
    const COL_PRACTICAS_OFERTA = "practicas_oferta";
    /**
     *
     */
    const COL_NO_INGLES_FORMAL_TOTAL = "no_ingles_formal_total";
    /**
     *
     */
    const COL_NO_INGLES_FORMAL_OFERTA = "no_ingles_formal_oferta";
    /**
     *
     */
    const COL_NO_INGLES_PRACTICAS_TOTAL = "no_ingles_practicas_total";
    /**
     *
     */
    const COL_NO_INGLES_PRACTICAS_OFERTA = "no_ingles_practicas_oferta";
    /**
     *
     */
    const COL_INGLES_FORMAL_TOTAL = "ingles_formal_total";
    /**
     *
     */
    const COL_INGLES_FORMAL_OFERTA = "ingles_formal_oferta";
    /**
     *
     */
    const COL_INGLES_FORMAL_BASICO_TOTAL = "ingles_formal_basico_total";
    /**
     *
     */
    const COL_INGLES_FORMAL_BASICO_OFERTA = "ingles_formal_basico_oferta";
    /**
     *
     */
    const COL_INGLES_FORMAL_INTERMEDIO_TOTAL = "ingles_formal_intermedio_total";
    /**
     *
     */
    const COL_INGLES_FORMAL_INTERMEDIO_OFERTA = "ingles_formal_intermedio_oferta";
    /**
     *
     */
    const COL_INGLES_FORMAL_AVANZADO_TOTAL = "ingles_formal_avanzado_total";
    /**
     *
     */
    const COL_INGLES_FORMAL_AVANZADO_OFERTA = "ingles_formal_avanzado_oferta";
    /**
     *
     */
    const COL_INGLES_PRACTICAS_TOTAL = "ingles_practicas_total";
    /**
     *
     */
    const COL_INGLES_PRACTICAS_OFERTA = "ingles_practicas_oferta";
    /**
     *
     */
    const COL_INGLES_PRACTICAS_BASICO_TOTAL = "ingles_practicas_basico_total";

    /**
     *
     */
    const COL_INGLES_PRACTICAS_BASICO_OFERTA = "ingles_practicas_basico_oferta";
    /**
     *
     */
    const COL_INGLES_PRACTICAS_INTERMEDIO_TOTAL = "ingles_practicas_intermedio_total";
    /**
     *
     */
    const COL_INGLES_PRACTICAS_INTERMEDIO_OFERTA = "ingles_practicas_intermedio_oferta";
    /**
     *
     */
    const COL_INGLES_PRACTICAS_AVANZADO_TOTAL = "ingles_practicas_avanzado_total";
    /**
     *
     */
    const COL_INGLES_PRACTICAS_AVANZADO_OFERTA = "ingles_practicas_avanzado_oferta";
    /**
     *
     */
    const COL_YEAR = 'year';
    /**
     *
     */
    const COL_MES = 'mes';
    /**
     * @var \Illuminate\Database\Query\Builder
     */
    protected $query;
    /**
     * @var array
     */
    protected $carreras;
    /**
     * @var
     */
    protected $fechaActual;
    /**
     * @var
     */
    protected $mesActual;
    /**
     * @var
     */
    protected $yearActual;
    /**
     * @var array
     */
    protected $fechas = array();
    /**
     * @var
     */
    protected $mesInicial;
    /**
     * @var
     */
    protected $columna;
    /**
     * @var
     */
    protected $tabla;
    /**
     * @var array
     */
    protected $meses = array();

    /**
     * @param $meses
     *
     * @return $this
     */
    public function meses($meses)
    {
        $this->rangoMeses = $meses;

        return $this;
    }

    /**
     * @param $tabla
     *
     * @return $this
     */
    public function tabla($tabla)
    {
        $this->verificarTabla($tabla);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getEstadisticas()
    {
        $this->obtenerFechas();

        $estadistica = array(
            "meses"     => $this->obtener_meses(),
            // vacantes totales
            "t"         => $this->obtener(self::COL_TOTAL . " as t"),
            // vacantes totales - oferta
            "to"        => $this->obtener(self::COL_TOTAL_OFERTA . " as to"),
            // vacantes formales totales
            "ft"        => $this->obtener(self::COL_FORMAL_TOTAL . " as ft"),
            // vacantes formales  - oferta
            "fo"        => $this->obtener(self::COL_FORMAL_OFERTA . " as fo"),
            // vacantes de practicante totales
            "pt"        => $this->obtener(self::COL_PRACTICAS_TOTAL . " as pt"),
            // vacantes de practicante  - oferta
            "po"        => $this->obtener(self::COL_PRACTICAS_OFERTA . " as po"),
            // vacantes formales totales que no solicitan ingles
            "nift"      => $this->obtener(self::COL_NO_INGLES_FORMAL_TOTAL . " as nift"),
            // vacantes formales  - oferta que no solicitan ingles
            "nifo"      => $this->obtener(self::COL_NO_INGLES_FORMAL_OFERTA . " as nifo"),
            // vacantes de practicante totales que no solicitan ingles
            "nipt"      => $this->obtener(self::COL_NO_INGLES_PRACTICAS_TOTAL . " as nipt"),
            // vacantes de practicante  - oferta que no solicitan ingles
            "nipo"      => $this->obtener(self::COL_NO_INGLES_PRACTICAS_OFERTA . " as nipo"),
            // vacantes formales totales que solicitan ingles
            "ift"       => $this->obtener(self::COL_INGLES_FORMAL_TOTAL . " as ift"),
            // vacantes formales - oferta  que solicitan ingles
            "ifo"       => $this->obtener(self::COL_INGLES_FORMAL_OFERTA . " as ifo"),
            // vacantes formales totales que solicitan ingles básico
            "ibft"      => $this->obtener(self::COL_INGLES_FORMAL_BASICO_TOTAL . " as ibft"),
            // vacantes formales - oferta  que solicitan ingles básico
            "ibfo"      => $this->obtener(self::COL_INGLES_FORMAL_BASICO_OFERTA . " as ibfo"),
            // vacantes formales totales que solicitan ingles intermedio
            "iift"      => $this->obtener(self::COL_INGLES_FORMAL_INTERMEDIO_TOTAL . " as iift"),
            // vacantes formales - oferta  que solicitan ingles intermedio
            "iifo"      => $this->obtener(self::COL_INGLES_FORMAL_INTERMEDIO_OFERTA . " as iifo"),
            // vacantes formales totales que solicitan ingles avanzado
            "iaft"      => $this->obtener(self::COL_INGLES_FORMAL_AVANZADO_TOTAL . " as iaft"),
            // vacantes formales - oferta  que solicitan ingles avanzado
            "iafo"      => $this->obtener(self::COL_INGLES_FORMAL_AVANZADO_OFERTA . " as iafo"),
            // vacantes de practicante totales que solicitan ingles
            "ipt"       => $this->obtener(self::COL_INGLES_PRACTICAS_TOTAL . " as ipt"),
            // vacantes de practicante - oferta  que solicitan ingles
            "ipo"       => $this->obtener(self::COL_INGLES_PRACTICAS_OFERTA . " as ipo"),
            // vacantes de practicante totales que solicitan ingles básico
            "ibpt"      => $this->obtener(self::COL_INGLES_PRACTICAS_BASICO_TOTAL . " as ibpt"),
            // vacantes de practicante - oferta  que solicitan ingles básico
            "ibpo"      => $this->obtener(self::COL_INGLES_PRACTICAS_BASICO_OFERTA . " as ibpo"),
            // vacantes de practicante totales que solicitan ingles intermedio
            "iipt"      => $this->obtener(self::COL_INGLES_PRACTICAS_INTERMEDIO_TOTAL . " as iipt"),
            // vacantes de practicante - oferta  que solicitan ingles intermedio
            "iipo"      => $this->obtener(self::COL_INGLES_PRACTICAS_INTERMEDIO_OFERTA . " as iipo"),
            // vacantes de practicante totales que solicitan ingles avanzado
            "iapt"      => $this->obtener(self::COL_INGLES_PRACTICAS_AVANZADO_TOTAL . " as iapt"),
            // vacantes de practicante - oferta  que solicitan ingles avanzado
            "iapo"      => $this->obtener(self::COL_INGLES_PRACTICAS_AVANZADO_OFERTA . " as iapo"),
            // software
            "programas" => $this->obtener("programas")
        );

        return $estadistica;
    }

    /**
     * @param $tabla
     */
    protected function verificarTabla($tabla)
    {
        $this->verificaString($tabla);

        $this->existeTabla($tabla);

        $this->tabla = $tabla;
    }

    /**
     * @param $tabla
     *
     * @throws \Exception
     */
    protected function verificaString($tabla)
    {
        if (! is_string($tabla))
        {
            throw new Exception("tabla no es de tipo \"string\": {$tabla} -> " . gettype($tabla));
        }
    }

    /**
     *
     */
    private function setCarreras()
    {
        if (! in_array(self::TAB_GENERAL, $this->carreras))
        {
            $this->agregarTablaGeneral();
        }
    }

    /**
     * @param $tabla
     *
     * @throws \Exception
     */
    private function existeTabla($tabla)
    {
        $this->setCarreras();

        if ($this->tablaNoExiste($tabla))
        {
            throw new Exception("Tabla no existente: {$tabla} <-");
        }
    }

    /**
     *
     */
    private function agregarTablaGeneral()
    {
        $this->carreras[] = self::TAB_GENERAL;
    }

    /**
     * @param $tabla
     *
     * @return bool
     */
    private function tablaNoExiste($tabla)
    {
        if (is_bool(array_search($tabla, $this->carreras)))
        {
            return true;
        }

        return false;
    }

    /**
     * @param $nombre
     *
     * @return array
     */
    private function obtener($nombre)
    {

        $this->setColumna($nombre);

        return array_map(array(
            $this,
            "obtenerDato"
        ), $this->fechas);
    }

    /**
     *
     */
    private function fechasActuales()
    {
        $this->fechaActual = Carbon::now("America/Mexico_City");

        $this->log->alert("fecha actual: {$this->fechaActual}");

        $this->mesActual = $this->fechaActual->month;

        $this->log->alert("mes actual: {$this->mesActual}");

        $this->yearActual = $this->fechaActual->year;

        $this->log->alert("año actual: {$this->yearActual}");
    }

    /**
     *
     */
    private function fechasParaCalcular()
    {
        $this->log->alert("rango meses: {$this->rangoMeses}");

        foreach (range(1, $this->rangoMeses) as $m)
        {
            $fecha = $this->obtener_fecha($m);
            $mes = $this->obtener_mes($m);

            $this->fechas[] = $fecha;
            $this->log->alert("fecha: {$fecha}");

            $this->meses[] = $mes;
            $this->log->alert("mes: {$mes}");
        }

        //        $this->meses_arr = array_reverse($this->meses_arr);

        //        $this->fechas_arr = array_reverse($this->fechas_arr);
    }

    /**
     * @param $m
     *
     * @return static
     */
    private function obtener_fecha($m)
    {
        return Carbon::create($this->yearActual, $this->mesActual)->startOfMonth()->subMonths($m);
    }

    /**
     * @param $m
     *
     * @return string
     */
    private function obtener_mes($m)
    {
        // para llenar las fechas en español
        setlocale(LC_ALL, 'es_ES');
        $dt = Carbon::create($this->yearActual, $this->mesActual)->startOfMonth()->subMonths($m);

        return ucfirst($dt->formatLocalized('%b %y'));
    }

    /**
     * @return array
     */
    public function obtener_meses()
    {
        $this->log->alert($this->meses);
        return $this->meses;
    }

    /**
     * @param Carbon $fecha
     *
     * @return mixed
     */
    private function obtenerDato(Carbon $fecha)
    {
        $this->log->debug(DB::connection('reportes')->table($this->tabla)->where(self::COL_YEAR, "=", $fecha->year)->where(self::COL_MES, "=", $fecha->month)->orderBy('created_at', 'desc')->toSql());
        $this->log->debug("year: {$fecha->year}, mes: {$fecha->month}");
        $jamon = DB::connection('reportes')->table($this->tabla)->where(self::COL_YEAR, "=", $fecha->year)->where(self::COL_MES, "=", $fecha->month)->orderBy('created_at', 'desc')->pluck($this->columna);

        return $jamon;
    }

    /**
     * @param $nombre
     */
    private function setColumna($nombre)
    {
        $this->columna = $nombre;
    }

    /**
     *
     */
    private function obtenerFechas()
    {
        $this->fechasActuales();
        $this->fechasParaCalcular();
    }
}
