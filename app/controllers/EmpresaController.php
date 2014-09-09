<?php

use Bolsa\Formularios\ActualizarEmpresaForm;
use Intervention\Image\Exception\NotWritableException;
use Laracasts\Validation\FormValidationException;

/**
 * Class EmpresaController
 */
class EmpresaController extends ApiBolsaController {

    /**
     * @var ActualizarEmpresaForm
     */
    protected $empresaForm;

    /**
     * @param ActualizarEmpresaForm $actualizarEmpresaForm
     */
    public function __construct(ActualizarEmpresaForm $actualizarEmpresaForm)
    {
        $this->empresaForm = $actualizarEmpresaForm;

        View::share("empresa", $this->empresa_en_sesion());

        $vacantes_activas = VacanteModel::where("status", VacanteModel::ACTIVA)->where("empresa_id", Auth::getUser()->empresa->id)->count();
        View::share("vacantes_activas", $vacantes_activas);

        $vacantes_cerradas = VacanteModel::onlyTrashed()->where("status", VacanteModel::CERRADA)->where("empresa_id", Auth::getUser()->empresa->id)->count();
        View::share("vacantes_cerradas", $vacantes_cerradas);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function editar()
    {
        return View::make("desktop.empresa.editar");
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    public function update()
    {
        try
        {
            $formData = Input::all();

            $this->empresaForm->validate($formData);
        }
        catch (FormValidationException $e)
        {

            return Redirect::back()->withInput()->withErrors($e->getErrors())
                ->with("alerta", "Hubo un problema con tus datos, corrígelos por favor.");
        }

        /** @var $empresa EmpresaModel */
        $empresa = $this->empresa_en_sesion();

        $empresaSlug = Str::slug(Input::get('nombre')) . $empresa->present()->id;

        if (Input::hasFile("logo"))
        {
            try
            {
                $logoPath = $this->obtenerLogoEmpresa($empresaSlug);

                $empresa->update(array("logo" => $logoPath));
            }
            catch (NotWritableException $e)
            {
                Log::error("error al subir imagen de la empresa: {$empresaSlug} al directorio");
            }
        }

        $empresa->update(array(
            "nombre"    => Input::get("nombre"),
            "direccion" => Input::get("direccion"),
            "giro"      => Input::get("giro"),
            "telefono"  => Input::get("telefono"),
            "slug"      => $empresaSlug
        ));

        return Redirect::route("empresa.inicio")->with("mensaje", "Datos Actualizados");
    }

    /**
     * @return \Illuminate\View\View
     * @throws Exception
     */
    public function inicio()
    {
        $vacantes = $this->vacantes_por_empresa($this->empresa_en_sesion()->id);

        $data = array('vacantes' => $vacantes);

        return View::make('desktop.empresa.inicio', $data);
    }

    /**
     * @return \Illuminate\View\View
     * @throws Exception
     */
    public function vacantes_activas()
    {
        $vacantes = $this->vacantes_por_empresa($this->empresa_en_sesion()->id);

        $data = array('vacantes' => $vacantes);

        return View::make('desktop.empresa.mostrar_vacantes', $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function vacantes_cerradas()
    {
        $vacantes = VacanteModel::onlyTrashed()->where("status", VacanteModel::CERRADA)->where("empresa_id", Auth::getUser()->empresa->id)->paginate(5);

        $data = array('vacantes' => $vacantes);

        return View::make('desktop.empresa.vacantes_cerradas', $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function enviar_feedback()
    {
        return View::make('desktop.empresa.enviar_feedback');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function crear_vacante()
    {
        $correoReclutador = Auth::getUser()->getEmail();

        $data = array(
            "correo"            => $correoReclutador,
            "titulado_lista"    => array("null" => "Seleccionar") + TituladoModel::lists("nombre", "id"),
            "experiencia_lista" => array("null" => "Seleccionar") + ExperienciaModel::lists("nombre", "id"),
            'tipo_lista'        => array("null" => "Seleccionar") + TipoVacanteModel::lists('tipo', 'id'),
            'ingles_lista'      => array("null" => "Seleccionar") + NivelInglesModel::lists('nivel', 'id'),
            'carreras_lista'    => array("null" => "Seleccionar") + CarreraModel::lists('nombre', 'id'),
        );

        return View::make("desktop.empresa.crear_vacante", $data);
    }

    /**
     * @param $vacante_id
     * @return $this|\Illuminate\View\View
     */
    public function editar_vacante($vacante_id)
    {
        $empresa = $this->empresa_en_sesion();

        list($vacante, $fail) = $this->buscar_vacante_activa($vacante_id);

        if ($fail)
        {
            return Redirect::route('empresa.inicio');
        }

        if ($this->vacante_pertenece_a_empresa($vacante_id, $empresa))
        {
            # no es una vacante de esta empresa o esta cerrada la vacante
            return Redirect::route('empresa.inicio');
        }

        $data = array(
            'vacante'           => $vacante,
            "titulado_lista"    => array("null" => "Seleccionar") + TituladoModel::lists("nombre", "id"),
            "experiencia_lista" => array("null" => "Seleccionar") + ExperienciaModel::lists("nombre", "id"),
            'tipo_lista'        => array("null" => "Seleccionar") + TipoVacanteModel::lists('tipo', 'id'),
            'ingles_lista'      => array("null" => "Seleccionar") + NivelInglesModel::lists('nivel', 'id'),
            'carreras_lista'    => array("null" => "Seleccionar") + CarreraModel::lists('nombre', 'id'),
        );

        return View::make("desktop.empresa.editar_vacante")->with($data);
    }

    /**
     * @param $id
     * @return $this|\Illuminate\View\View|string
     */
    public function vacante_aplicantes($id)
    {
        $empresa = $this->empresa_en_sesion();

        if ($this->vacante_pertenece_a_empresa($id, $empresa))
        {
            return "auth: no es una vacante de esta empresa: {$empresa->user_id}";
        }

        $vacante = VacanteModel::withTrashed()->with("aplicantes")->where("string_id", $id)->firstOrFail();

        $data = array(
            'vacante' => $vacante
        );

        return View::make("desktop.empresa.vacante_aplicantes")->with($data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    public function cerrar_vacante($id)
    {
        $empresa = $this->empresa_en_sesion();

        /** @var $vacante VacanteModel */
        /** @var $fail bool */
        list($vacante, $fail) = $this->buscar_vacante_activa($id);

        if ($fail)
        {
            return Redirect::route('empresa.inicio');
        }

        if ($this->vacante_pertenece_a_empresa($id, $empresa))
        {
            # no es una vacante de esta empresa o esta cerrada la vacante
            return Redirect::route('empresa.inicio')->with("alerta", "Hubo un error intentalo más tarde.");;
        }

        $tituloVacante = $vacante->present()->titulo;
        # http://laravel.com/docs/eloquent#soft-deleting
        $vacante->update(array(
            "status" => VacanteModel::CERRADA
        ));

        $vacante->delete();

        return Redirect::route('empresa.inicio')->with("mensaje", "La vacante <strong>\"{$tituloVacante}\"</strong> ha sido cerrada.");
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reabrir_vacante($id)
    {
        try
        {
            $this->restaurar_vacante($id);

            return Redirect::route('empresa.inicio')->with("mensaje", "La vacante ha sido restaurada.");
        }
        catch (Exception $e)
        {
            return Redirect::route('empresa.inicio')->with("alerta", "Hubo un problema por favor intenta más tarde.");
        }
    }

    /**
     * @throws FormValidationException
     */
    protected function validarRegistroEmpresa()
    {
        $input = Input::all();

        $this->empresaForm->validate($input);
    }

    /**
     * @param $id
     * @throws Exception
     */
    private function restaurar_vacante($id)
    {
        $empresa = $this->empresa_en_sesion();

        # validar que existe vacante "cerrada"
        /** @var $vacante VacanteModel */
        /** @var $fail bool */
        list($vacante, $fail) = VacanteRepositorio::get_closed_job($id);

        if ($fail)
        {
            throw new Exception("la vacante: {$id}, no existe.");
        }

        if ($this->vacante_pertenece_a_empresa($id, $empresa))
        {
            throw new Exception("la vacante: {$id}, no pertenece a la empresa: {$empresa->id}.");
        }

        # http://laravel.com/docs/eloquent#soft-deleting
        $vacante->restore();

        $vacante->update(array(
            "status" => VacanteModel::ACTIVA
        ));
    }
}
