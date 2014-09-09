<?php
use Bolsa\Repositorios\JobRepository;

/**
 * Class BolsaController
 */
class BolsaController extends ApiBolsaController {

    /**
     *
     */
    const TIPO_VACANTE = 'tipo_id';

    /**
     * @return \Illuminate\View\View
     */
    public function seleccion()
    {
        $data = array(
            'vacantes_practicantes' => VacanteModel::where(self::TIPO_VACANTE, 2)->count('id'),
            'vacantes_formales'     => VacanteModel::where(self::TIPO_VACANTE, 1)->count('id')
        );

        return View::make('desktop.bolsa.inicio')->with($data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function mostrar_vacantes($tipo_de_vacante)
    {

        list($tipo_id, $fail) = $this->validar_tipo_de_vacante($tipo_de_vacante);

        if ($fail)
        {
            return Redirect::route('bolsa.inicio');
        }

        $vacantes = $this->obtener_vacantes($tipo_id);

        $carreras = $this->obtener_carreras($tipo_id);

        $data = array(
            'txt_subtitulo'    => "{$tipo_de_vacante}",
            'carreras'         => $carreras,
            'vacantes'         => $vacantes,
            'vacantes_totales' => $vacantes->getTotal(),
            'vacantes_tipo'    => $tipo_de_vacante
        );

        return View::make('desktop.bolsa.mostrar_vacantes')->with($data);
    }

    /**
     * @param $tipo_vacante
     * @param $carrera_nombre
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function vacantes_de_carrera($tipo_vacante, $carrera_nombre)
    {

        list($tipo_id, $fail) = $this->validar_tipo_de_vacante($tipo_vacante);

        if ($fail)
        {
            return Redirect::route('bolsa.inicio');
        }

        list($carrera_id, $fail) = $this->validar_carrera($carrera_nombre);

        if ($fail)
        {
            return Redirect::route('bolsa.inicio', array($tipo_vacante));
        }

        $vacantes = $this->vacantes_por_carrera($carrera_id, $tipo_id);

        $txt_subtitle = "{$tipo_vacante} - {$carrera_nombre}";

        $datos = array(
            'txt_subtitulo'    => $txt_subtitle,
            'carreras'         => $this->obtener_carreras($tipo_id),
            'carrera_nombre'   => $carrera_nombre,
            'vacantes_totales' => $vacantes->getTotal(),
            'vacantes_tipo'    => $tipo_vacante,
            'vacantes'         => $vacantes
        );

        return View::make('desktop.bolsa.mostrar_vacantes')->with($datos);
    }

    /**
     * @param $tipo_vacante
     * @param $empresa
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function vacantes_de_empresa($tipo_vacante, $empresa)
    {
        list($tipo_id, $fail) = $this->validar_tipo_de_vacante($tipo_vacante);

        if ($fail)
        {
            return Redirect::route('bolsa.inicio');
        }

        list($empresa_id, $fail) = $this->validar_empresa($empresa);

        if ($fail)
        {
            return Redirect::route('bolsa.inicio', array($tipo_vacante));
        }

        $vacantes = $this->vacantes_por_empresa($empresa_id, $tipo_id);

        $carreras = $this->obtener_carreras($tipo_id, $empresa_id);

        /** @var $empresaModel EmpresaModel */
        $empresaModel = EmpresaModel::where("slug", $empresa)->firstOrFail();

        $datos = array(
            'txt_subtitulo'    => $tipo_vacante . " - " . $empresaModel->present()->nombre,
            'empresa'          => Str::slug($empresa),
            'carreras'         => $carreras,
            'vacantes'         => $vacantes,
            'vacantes_tipo'    => $tipo_vacante,
            'vacantes_totales' => $vacantes->getTotal()
        );

        return View::make('desktop.bolsa.vacantes_de_empresa')->with($datos);
    }

    /**
     * @param $tipo_vacante
     * @param $empresa
     * @param $carrera
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function vacantes_de_carrera_por_empresa($tipo_vacante, $empresa, $carrera)
    {
        list($tipo_id, $fail) = $this->validar_tipo_de_vacante($tipo_vacante);

        if ($fail)
        {
            return Redirect::route('bolsa.inicio');
        }

        list($empresa_id, $fail) = $this->validar_empresa($empresa);

        if ($fail)
        {
            return Redirect::route('bolsa.inicio', array($tipo_vacante));
        }

        list($carrera_id, $fail) = $this->validar_carrera($carrera);

        if ($fail)
        {
            return Redirect::route('bolsa.inicio.empresa', array(
                $tipo_vacante,
                $empresa
            ));
        }

        $vacantes = $this->vacantes_por_empresa_carrera($empresa_id, $carrera_id, $tipo_id);

        $carreras = $this->obtener_carreras($tipo_id, $empresa_id);

        /** @var $empresaModel EmpresaModel */
        $empresaModel = EmpresaModel::where("slug", $empresa)->firstOrFail();

        $datos = array(
            'txt_subtitulo'    => "{$tipo_vacante} - {$carrera} - {$empresaModel->present()->nombre}",
            'empresa'          => Str::slug($empresa),
            'carrera'          => Str::slug($carrera),
            'carreras'         => $carreras,
            'vacantes'         => $vacantes,
            'vacantes_tipo'    => $tipo_vacante,
            'vacantes_totales' => $vacantes->getTotal()
        );

        return View::make('desktop.bolsa.vacantes_de_empresa')->with($datos);
    }

    /**
     * @param $carrera_nombre
     * @param $vacante_id
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function vacante($tipo_vacante, $vacante_id)
    {

        list($tipo_id, $fail) = $this->validar_tipo_de_vacante($tipo_vacante);

        if ($fail)
        {
            return Redirect::route('bolsa.inicio');
        }

        list($vacante, $fail) = $this->buscar_vacante_activa($vacante_id);

        if ($fail)
        {
            return Redirect::route('bolsa.inicio', array($tipo_vacante));
        }

        $carrera_id = $vacante->present()->carrera_id;

        $repositorio = new JobRepository(new VacanteModel);

        $vacantes = $this->vacantes_por_empresa($vacante->present()->empresa_id, $tipo_id);

        $tot_carrera = $repositorio->count_jobs(array('carrera_id' => $carrera_id), $tipo_id);

        $datos = array(
            'vacante'       => $vacante,
            'vacante_tipo'  => $tipo_vacante,
            'total_empresa' => $vacantes->getTotal(),
            'carrera_total' => $tot_carrera,
        );

        return View::make('desktop.bolsa.vacante')->with($datos);
    }

    /**
     *
     */
    protected function validarRegistroEmpresa()
    {
        $input = Input::all();

        $this->empresaForm->validate($input);
    }
}
