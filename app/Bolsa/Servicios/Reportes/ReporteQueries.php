<?php namespace Bolsa\Reportes;

use Illuminate\Support\Collection;
use League\Fractal;
use Str;
use VacanteModel;

/**
 * Class QueryReporte
 * @package Bolsa\Reportes
 */
class ReporteQueries {

    const TIPO_VACANTE = 'tipo_id';

    const CARRERA_ID = 'carrera_id';

    const OFERTA = 'oferta';

    const NIVEL_INGLES = 'ingles_id';

    const SOFTWARE = "software";

    /**
     * @var array
     */
    protected $rangoFechas;
    /**
     * @var \VacanteModel
     */
    protected $vacantesEloquent;
    /**
     * @var int
     */
    protected $carreraId;

    /**
     * @param array $rango
     * @param null  $carreraId
     */
    public function tabla(array $rango, $carreraId = null)
    {
        $this->rangoFechas = $rango;

        $this->carreraId = $carreraId;

        $this->vacantesEloquent = VacanteModel::withTrashed()->whereBetween('created_at', $rango);
    }

    /**
     * @return int
     */
    public function obtener_totales()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->count();
    }

    /**
     * @return int
     */
    public function obtenerVacantesPracticantes()
    {

        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->count();
    }

    /**
     * @return int
     */
    public function obtenerVacantesFormales()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->count();
    }

    /**
     * @return int
     */
    public function obtener_avg_totales_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function obtener_avg_vacantes_practicante_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function obtener_avg_vacantes_formales_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function obtener_vacantes_formal_ingles_total()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '<>', 1)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '<>', 1)->count();
    }

    /**
     * @return int
     */
    public function obtener_avg_vacantes_formal_ingles_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '<>', 1)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '<>', 1)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function ingles_basico_formal_total()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 2)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 2)->count();
    }

    /**
     * @return int
     */
    public function ingles_basico_formal_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 2)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 2)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function ingles_intermedio_formal_total()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 3)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 3)->count();
    }

    /**
     * @return int
     */
    public function ingles_intermedio_formal_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 3)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 3)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function ingles_avanzado_formal_total()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 4)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 4)->count();
    }

    /**
     * @return int
     */
    public function ingles_avanzado_formal_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 4)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 4)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function ingles_practicas_total()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '<>', 1)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '<>', 1)->count();
    }

    /**
     * @return int
     */
    public function ingles_practicas_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '<>', 1)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '<>', 1)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function ingles_basico_practicas_total()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 2)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 2)->count();
    }

    /**
     * @return int
     */
    public function ingles_basico_practicas_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 2)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 2)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function ingles_intermedio_practicas_total()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 3)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 3)->count();
    }

    /**
     * @return int
     */
    public function ingles_intermedio_practicas_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 3)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 3)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function ingles_avanzado_practicas_total()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 4)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 4)->count();
    }

    /**
     * @return int
     */
    public function ingles_avanzado_practicas_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 4)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 4)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function no_ingles_formal_total()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 1)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 1)->count();
    }

    /**
     * @return int
     */
    public function no_ingles_formal_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 1)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '=', 1)->where(self::NIVEL_INGLES, '=', 1)->avg(self::OFERTA);
    }

    /**
     * @return int
     */
    public function no_ingles_practicas_total()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 1)->count();
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 1)->count();
    }

    /**
     * @return int
     */
    public function no_ingles_practicas_oferta()
    {
        if ($this->isGerenal())
        {
            return (int) $this->vacantesEloquent->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 1)->avg(self::OFERTA);
        }

        return (int) $this->vacantesEloquent->where(self::CARRERA_ID, '=', $this->carreraId)->where(self::TIPO_VACANTE, '<>', 1)->where(self::NIVEL_INGLES, '=', 1)->avg(self::OFERTA);
    }

    /**
     * @param ReporteFechas $opciones
     *
     * @return string
     */
    public function programasJSON(ReporteFechas $opciones = null)
    {
        if ($this->isGerenal())
        {
            $vacantesCollection = $this->vacantesEloquent->get(array(self::SOFTWARE));

            $programas = $this->obtenerProgramas($vacantesCollection);
        }
        else
        {
            $vacantesCollection = $this->vacantesEloquent->where(self::CARRERA_ID, $this->carreraId)->get(array(self::SOFTWARE));

            $programas = $this->obtenerProgramas($vacantesCollection);
        }

        return $this->obtenerJSON($programas);
    }

    /**
     * @return bool
     */
    private function isGerenal()
    {
        if ($this->carreraId == null)
        {
            return true;
        }

        return false;
    }

    /**
     * @param $programas
     *
     * @return string
     */
    private function obtenerJSON($programas)
    {
        /**
         * info: http://fractal.thephpleague.com/simple-example/
         */
        $fractal = new Fractal\Manager();

        $resource = new Fractal\Resource\Collection($programas, function ($programa)
        {
            return array('nombre' => $programa['nombre'], 'cantidad' => (int) $programa['cantidad']);
        });

        // Turn all of that into JSON
        return $fractal->createData($resource)->toJson();
    }

    /**
     * @param $vacantesCollection
     *
     * @return array
     */
    private function obtenerProgramas(Collection $vacantesCollection)
    {

        $softwareString = $vacantesCollection->reduce(function ($string, $vacante)
        {
            $string .= $vacante->software;
            return $string;
        });

        $softwareArray = explode(",", $softwareString);

        $cleanSoftwareArray = array_map(function ($softwareName)
        {
            return Str::slug($softwareName);
        }, $softwareArray);

        $softwareCountsCollection = Collection::make(array_count_values($cleanSoftwareArray))->sortByDesc(function ($a)
        {
            return $a;
        });

        $programas = array();

        foreach ($softwareCountsCollection->take(10) as $a => $b)
        {
            $programas[] = array("nombre" => $a, "cantidad" => $b);
        }

        return $programas;
    }
}
