<?php
use Bolsa\Formularios\NuevaVacanteForm;
use Bolsa\Repositorios\JobRepository;
use Laracasts\Validation\FormValidationException;

/**
 * Class ApiBolsaController
 */
class ApiBolsaController extends BaseController {

    /**
     *
     */
    const MAX_VACANTES = 5;

    /**
     *
     */
    const TIPO_FORMAL = 1;

    /**
     *
     */
    const TIPO_PRACTICANTE = 2;

    /**
     * @return \Illuminate\Pagination\Paginator
     */
    protected function obtener_vacantes($tipo_id = null)
    {
        if ($tipo_id == self::TIPO_FORMAL)
        {
            $vacantes = ObtenerVacantes::formales($this->pagina(), self::MAX_VACANTES);

            return $this->paginar($vacantes);
        }
        if ($tipo_id == self::TIPO_PRACTICANTE)
        {
            $vacantes = ObtenerVacantes::practicantes($this->pagina(), self::MAX_VACANTES);

            return $this->paginar($vacantes);
        }

        throw new Exception("tipo de vacante incorrento: {$tipo_id}");
    }

    /**
     * @param $empresa_id
     * @param null $tipo_id
     * @return \Illuminate\Pagination\Paginator
     * @throws Exception
     */
    protected function vacantes_por_empresa($empresa_id, $tipo_id = null)
    {
        if (is_null($tipo_id))
        {
            $vacantes = ObtenerVacantes::activas_por_empresa($empresa_id, $this->pagina(), self::MAX_VACANTES);

            return $this->paginar($vacantes);
        }
        if ($tipo_id == self::TIPO_FORMAL)
        {
            $vacantes = ObtenerVacantes::formales_por_empresa($empresa_id, $this->pagina(), self::MAX_VACANTES);

            return $this->paginar($vacantes);
        }
        if ($tipo_id == self::TIPO_PRACTICANTE)
        {
            $vacantes = ObtenerVacantes::practicantes_por_empresa($empresa_id, $this->pagina(), self::MAX_VACANTES);

            return $this->paginar($vacantes);
        }

        throw new Exception("tipo de vacante incorrento: {$tipo_id}");
    }

    /**
     * @param $carrera_id
     * @param $tipo_id
     * @return \Illuminate\Pagination\Paginator
     * @throws Exception
     */
    protected function vacantes_por_carrera($carrera_id, $tipo_id)
    {
        if ($tipo_id == self::TIPO_FORMAL)
        {
            $vacantes = ObtenerVacantes::formales_por_carrera($carrera_id, $this->pagina(), self::MAX_VACANTES);

            return $this->paginar($vacantes);
        }
        if ($tipo_id == self::TIPO_PRACTICANTE)
        {
            $vacantes = ObtenerVacantes::practicantes_por_carrera($carrera_id, $this->pagina(), self::MAX_VACANTES);

            return $this->paginar($vacantes);
        }

        throw new Exception("tipo de vacante incorrento: {$tipo_id}");
    }

    /**
     * @param $keyword
     * @param $carrera_id
     * @param $tipo_id
     * @return \Illuminate\Pagination\Paginator
     * @throws Exception
     */
    protected function vacantes_por_keyword($keyword, $carrera_id, $tipo_id)
    {
        if ($tipo_id == self::TIPO_FORMAL)
        {
            $vacantes = ObtenerVacantes::formales_por_keyword($keyword, $carrera_id, $this->pagina(), self::MAX_VACANTES);

            return $this->paginar($vacantes);
        }
        if ($tipo_id == self::TIPO_PRACTICANTE)
        {
            $vacantes = ObtenerVacantes::practicantes_por_keyword($keyword, $carrera_id, $this->pagina(), self::MAX_VACANTES);

            return $this->paginar($vacantes);
        }

        throw new Exception("tipo de vacante incorrento: {$tipo_id}");
    }

    /**
     * @return int
     */
    protected function pagina()
    {
        if (is_null(Input::get('page')))
        {
            return 1;
        }
        else
        {
            return (int) Input::get('page');
        }
    }

    /**
     * @param $vacantes
     *
     * @return \Illuminate\Pagination\Paginator
     */
    protected function paginar($vacantes)
    {
        return Paginator::make($vacantes->jobs, $vacantes->totalJobs, $vacantes->jobsPerPage);
    }

    /**
     * @param $carrera
     *
     * @return bool
     */
    protected function carrera_inexistente($carrera)
    {
        return $this->verifica_carrera($carrera);
    }

    /**
     * @param $carrera
     *
     * @return bool
     */
    protected function verifica_carrera($carrera)
    {
        if ($this->carrera_es_valida($carrera, $this->lista_de_carreras()))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * @param $empresa_nombre
     * @return array
     */
    protected function validar_empresa($empresa_nombre)
    {
        if (! $this->empresa_existe($empresa_nombre, $this->lista_de_empresas()))
        {
            return array(null, true);
        }

        return array($this->obtener_empresa_id($empresa_nombre, $this->lista_de_empresas()), false);
    }

    /**
     * @param $id
     * @return \Illuminate\Pagination\Paginator
     */
    protected function vacantes_cerradas_por_empresa($id)
    {
        $vacantes = ObtenerVacantes::cerradas_por_empresa($id, $this->pagina(), self::MAX_VACANTES);

        return $this->paginar($vacantes);
    }

    /**
     * @param $id
     * @param $empresa
     *
     * @return bool
     */
    protected function vacante_pertenece_a_empresa($id, $empresa)
    {
        return is_null(VacanteModel::withTrashed()->where('string_id', $id)->where('empresa_id', $empresa->id)->first());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
     */
    protected function empresa_en_sesion()
    {
        $user_id = Auth::user()->getAuthIdentifier();

        $empresa = EmpresaModel::with("reclutador")->where('user_id', $user_id)->firstOrFail();

        return $empresa;
    }

    /**
     * @param $empresa
     *
     * @return int
     */
    protected function contar_vacantes_cerradas_por_empresa($empresa)
    {
        $num_vacantes_cerradas = VacanteModel::where('empresa_id', $empresa->id)->onlyTrashed()->count('id');

        return $num_vacantes_cerradas;
    }

    /**
     * @param $empresa
     *
     * @return int
     */
    protected function contar_vacantes_activas_por_empresa($empresa)
    {
        $num_vacantes_activas = VacanteModel::where('empresa_id', $empresa->id)->count('id');

        return $num_vacantes_activas;
    }

    /**
     * @param $info
     */
    protected function actualizar_vacante($id, NuevaVacanteForm $nuevaVacanteForm)
    {
        list($dataVacante, $fail, $errores) = $this->validar_data_vacante($nuevaVacanteForm);

        if ($fail)
        {
            return array(true, $errores);
        }

        $empresa = $this->empresa_en_sesion();

        $empresa->vacantes()->where('string_id', $id)->firstOrFail()->update($dataVacante);

        return array(false, null);
    }

    /**
     * @param $info
     */
    protected function crear_nueva_vacante(NuevaVacanteForm $nuevaVacanteForm)
    {
        list($nueva_vacante, $fail, $errores) = $this->validar_data_vacante($nuevaVacanteForm);

        if ($fail)
        {
            return array(true, $errores);
        }

        $empresa = $this->empresa_en_sesion();

        array_set($nueva_vacante, 'string_id', $this->siguiente_string_id());

        $vacante = new VacanteModel($nueva_vacante);

        $empresa->vacantes()->save($vacante);

        return array(false, null);
    }

    /**
     * @return string
     */
    protected function siguiente_string_id()
    {
        if(VacanteModel::withTrashed()->get()->count() === 0)
        {
            $siguienteID = 1;
        }
        else
        {
            $siguienteID = (int) VacanteModel::withTrashed()->latest('id')->first(array('id'))->id + 1;
        }


        $stringId = Config::get('bolsa.ofuscator.offset') + $siguienteID;

        return (string) Tiny::to($stringId);
    }

    /**
     * @param NuevaVacanteForm $nuevaVacanteForm
     * @return array
     */
    protected function validar_data_vacante(NuevaVacanteForm $nuevaVacanteForm)
    {
        try
        {
            $input = Input::all();

            $nuevaVacanteForm->validate($input);
        }
        catch (FormValidationException $errores)
        {
            return array(null, true, $errores);
        }

        array_set($input, 'rotar', Input::get("c_rotar") === "true");
        array_set($input, 'viajar', Input::get("c_viajar") === "true");
        array_set($input, 'prima', Input::get("c_prima") === "true");
        array_set($input, 'vales', Input::get("c_vales") === "true");
        array_set($input, 'transporte', Input::get("c_transporte") === "true");
        array_set($input, 'residencia', Input::get("c_residencia") === "true");
        array_set($input, 'aguinaldo', Input::get("c_aguinaldo") === "true");
        array_set($input, 'comision', Input::get("c_comision") === "true");
        array_set($input, 'seguro', Input::get("c_seguro") === "true");
        array_set($input, 'comedor', Input::get("c_comedor") === "true");
        array_set($input, 'viaticos', Input::get("c_viaticos") === "true");
        array_set($input, 'gasolina', Input::get("c_gasolina") === "true");
        array_set($input, 'honorarios', Input::get("c_honorarios") === "true");

        return array($input, false, null);
    }

    /**
     * @param $empresaSlug
     * @return string
     */
    protected function obtenerLogoEmpresa($empresaSlug)
    {
        $logoEmpresa = Image::make(Input::file('logo')->getRealPath());

        $logoPath = empresa_images_path();

        $logoNombre = "104-" . $empresaSlug;

        # reajusta la imagen a 104 pixeles de ancho, http://image.intervention.io/api/resize
        $logoEmpresa->widen(104);

        $logoEmpresa->save($logoPath . $logoNombre, 80);

        return $logoNombre;
    }

    /**
     * @param $carrera_nombre
     *
     * @return mixed
     */
    private function obtener_carrera_id($carrera_nombre, $lista_carreras)
    {
        return array_search(strtolower($carrera_nombre), $lista_carreras);
    }

    /**
     * @param $vacante
     *
     * @return VacanteModel && bool
     */
    protected function buscar_vacante_activa($vacante)
    {
        list($vacante, $fail) = ObtenerVacantes::por_id($vacante);

        if ($fail)
        {
            return array(null, true);
        }
        return array($vacante, false);
    }

    /**
     * @param $empresa_id
     * @param $carrera_id
     * @param $tipo_id
     * @return \Illuminate\Pagination\Paginator
     */
    protected function vacantes_por_empresa_carrera($empresa_id, $carrera_id, $tipo_id)
    {
        $repo = new JobRepository(new VacanteModel);

        $columns = array("empresa_id" => $empresa_id, "carrera_id" => $carrera_id);

        $vac = $repo->get_jobs_by_2_columns($columns, $this->pagina(), self::MAX_VACANTES, $tipo_id);

        return $this->paginar($vac);
    }

    /**
     * @param $tipo_nombre
     * @return bool
     */
    protected function tipo_vacante_no_es_valido($tipo_nombre)
    {
        return ! $this->tipo_vacante_es_valido($tipo_nombre, $this->lista_tipos_vacante());
    }

    /**
     * @param $tipo_string
     *
     * @return array
     */
    protected function validar_tipo_de_vacante($tipo_string)
    {
        if (! $this->tipo_vacante_es_valido($tipo_string, $this->lista_tipos_vacante()))
        {
            $this->log($tipo_string, __FUNCTION__);

            return array(null, true);
        }
        return array($this->obtener_tipo_vacante_id($tipo_string, $this->lista_tipos_vacante()), false);
    }

    /**
     * @param $carrera_nombre
     * @return array
     */
    protected function validar_carrera($carrera_nombre)
    {
        if (! $this->carrera_es_valida($carrera_nombre, $this->lista_de_carreras()))
        {
            $this->log($carrera_nombre, __FUNCTION__);

            return array(null, true);
        }
        return array($this->obtener_carrera_id($carrera_nombre, $this->lista_de_carreras()), false);
    }

    /**
     * @param $tipo_vacante
     * @param $lista_tipo_vacante
     * @return mixed
     */
    private function obtener_tipo_vacante_id($tipo_vacante, $lista_tipo_vacante)
    {
        return array_search(strtolower($tipo_vacante), $lista_tipo_vacante);
    }

    /**
     * @param $parametro
     */
    private function log($parametro, $metodo, $mensaje = null)
    {
        $msg = "~ {$mensaje} {$parametro}";

        $ctx = __CLASS__ . "@" . $metodo;

        Log::error($msg, array($ctx));
    }

    /**
     * @param $tipo_nombre
     * @param $lista_tipos_vacante
     * @return bool
     */
    private function tipo_vacante_es_valido($tipo_nombre, $lista_tipos_vacante)
    {
        return in_array(strtolower($tipo_nombre), $lista_tipos_vacante);
    }

    /**
     * @param $empresa
     *
     * @return int
     * @throws Exception
     */
    private function obtener_empresa_id($empresa, $lista_empresas)
    {
        return array_search(strtolower($empresa), $lista_empresas);
    }

    /**
     * @param $carrera
     *
     * @return bool
     */
    private function carrera_es_valida($carrera, $lista_carreras)
    {
        return in_array(strtolower($carrera), $lista_carreras);
    }

    /**
     * @return array
     */
    private function lista_de_empresas()
    {
        return EmpresaModel::lists('slug', 'id');
    }

    /**
     * @return array
     */
    protected function lista_de_carreras()
    {
        return CarreraModel::lists('slug', 'id');
    }

    /**
     * @return array
     */
    private function lista_tipos_vacante()
    {
        return TipoVacanteModel::lists('slug', 'id');
    }

    /**
     * @param $tipo_id
     * @param null $empresa_id
     * @param null $keyword
     * @return mixed
     */
    protected function obtener_carreras($tipo_id, $empresa_id = null, $keyword = null)
    {
        $carreras = CarreraModel::all(array('id', 'nombre', 'slug'));

        $carreras->transform(function ($carrera) use ($empresa_id, $tipo_id, $keyword)
        {
            if (is_null($empresa_id) && is_null($keyword))
            {
                $carrera->total = $this->contar_vacantes_por_carrera($carrera->id, $tipo_id);

                return $carrera;
            }
            if (is_null($empresa_id) && ! is_null($keyword))
            {
                $carrera->total = $this->contar_vacantes_por_carrera($carrera->id, $tipo_id, $keyword);

                return $carrera;
            }
            if (! is_null($empresa_id) && is_null($keyword))
            {
                $carrera->total = $this->contar_vacantes_empresa_carrera($empresa_id, $carrera->id, $tipo_id);

                return $carrera;
            }
        });

        return $carreras;
    }

    /**
     * @param $carrera_id
     * @param null $tipo_id
     * @param null $keyword
     * @return int
     */
    private function contar_vacantes_por_carrera($carrera_id, $tipo_id = null, $keyword = null)
    {
        $repo = new JobRepository(new VacanteModel);

        if (! is_null($keyword))
        {
            return $repo->count_jobs_by_keyword($keyword, $carrera_id, $tipo_id);
        }

        $columnas = array("carrera_id" => $carrera_id);

        return $repo->count_jobs($columnas, $tipo_id);
    }

    /**
     * @param $empresa_id
     * @param $carrera_id
     * @param null $tipo_id
     * @return int
     */
    protected function contar_vacantes_empresa_carrera($empresa_id, $carrera_id, $tipo_id = null)
    {
        $repo = new JobRepository(new VacanteModel);

        $columnas = array("empresa_id" => $empresa_id, "carrera_id" => $carrera_id);

        return $repo->count_jobs($columnas, $tipo_id);
    }

    /**
     * @param $carrera_nombre
     * @param $lista_carreras
     * @return bool
     */
    private function empresa_existe($carrera_nombre, $lista_carreras)
    {
        return in_array(strtolower($carrera_nombre), $lista_carreras);
    }
}
