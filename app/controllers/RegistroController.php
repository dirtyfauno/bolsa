<?php

use Bolsa\Formularios\RegistroAplicanteForm;
use Bolsa\Formularios\RegistroEmpresaForm;
use Illuminate\Database\QueryException;
use Intervention\Image\Exception\NotWritableException;
use Laracasts\Validation\FormValidationException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class RegistroController
 */
class RegistroController extends ApiBolsaController {

    /**
     * @var RegistroEmpresaForm
     */
    protected $empresaForm;
    /**
     * @var RegistroAplicanteForm
     */
    protected $aplicanteForm;

    /**
     * @param RegistroEmpresaForm $registroEmpresa
     * @param RegistroAplicanteForm $aplicanteForm
     */
    public function __construct(RegistroEmpresaForm $registroEmpresa, RegistroAplicanteForm $aplicanteForm)
    {
        $this->empresaForm = $registroEmpresa;
        $this->aplicanteForm = $aplicanteForm;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function registroEmpresa()
    {
        return View::make('test.registro.empresa');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function aplicante()
    {
        try
        {

            $this->aplicanteForm->validate(Input::all());
        }
        catch (FormValidationException $e)
        {
            return Redirect::back()->withInput()->withErrors($e->getErrors())->with("alerta", "Hubo un problema con tus datos, corrígelos por favor.");;
        }

        $nuevoUsuario = $this->crearNuevoUsuario(TipoUsuarioModel::APLICANTE);

        $nuevoAplicante = new AplicanteModel;

        try
        {
            $cv_name = $nuevoUsuario->id . "u_" . Str::random(6) . "." . Input::file("cv")->getClientOriginalExtension();

            Input::file('cv')->move(cv_path(), $cv_name);

            $nuevoAplicante->cv = $cv_name;
        }
        catch (FileException $e)
        {
            Log::error("error al subir cv del usuario {$nuevoUsuario->id}: al directorio de cv");
            Log::error($e->getMessage());

            $nuevoUsuario->forceDelete();

            return Redirect::back()->withInput()->with("alerta", "Hubo un problema con tu currículum, intenta de nuevo.");
        }

        $nuevoAplicante->user_id = $nuevoUsuario->id;
        $nuevoAplicante->nombre = Input::get('nombre');
        $nuevoAplicante->mailing = true;
        $nuevoAplicante->carrera = Input::get('carrera');
        $nuevoAplicante->universidad_id = Input::get('universidad_id');
        $nuevoAplicante->matricula = Input::get('matricula');

        try
        {
            $nuevoAplicante->save();
        }
        catch (QueryException $e)
        {
            $nuevoUsuario->forceDelete();

            Log::error($e->getMessage());

            return Redirect::back()->withInput()->with("alerta", "Hubo un problema por favor intenta de nuevo.");
        }

        Auth::login($nuevoUsuario);

        return Redirect::route("aplicante.inicio");
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function empresa()
    {
        try
        {
            $this->empresaForm->validate(Input::all());
        }
        catch (FormValidationException $e)
        {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        $nuevoUsuario = $this->crearNuevoUsuario(TipoUsuarioModel::RECLUTADOR);

        $nuevaEmpresa = new EmpresaModel;

        $empresaSlug = Str::slug(Input::get('nombre'));

        $logo = "";

        try
        {
            $logo = $this->obtenerLogoEmpresa($empresaSlug);
        }
        catch (NotWritableException $e)
        {
            Log::error("error al subir imagen de la empresa: {$empresaSlug} al directorio");

            $nuevaEmpresa->logo = "error";
        }

        $nuevaEmpresa->user_id = $nuevoUsuario->id;
        $nuevaEmpresa->nombre = Input::get('nombre');
        $nuevaEmpresa->reclutador_nombre = Input::get('reclutador_nombre');
        $nuevaEmpresa->status = EmpresaModel::PENDIENTE;
        $nuevaEmpresa->giro = Input::get('giro');
        $nuevaEmpresa->rfc = Input::get('rfc');
        $nuevaEmpresa->telefono = Input::get('telefono');
        $nuevaEmpresa->direccion = Input::get('direccion');
        $nuevaEmpresa->slug = $empresaSlug . $nuevoUsuario->id;
        $nuevaEmpresa->logo = $logo;

        try
        {
            $nuevaEmpresa->save();
        }
        catch (QueryException $e)
        {
            $nuevoUsuario->forceDelete();

            Log::error($e->getMessage());

            return Redirect::back()->withInput()->with("alerta", "Hubo un problema por favor intenta de nuevo.");
        }

        // como la empresa se dará de alta por la administración la borramos temporalmente.
        $nuevaEmpresa->delete();

        return Redirect::route('bolsa.inicio')->with("mensaje", "Has sido registrado, te notificaremos por correo cuando este activa tu cuenta.");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    private function crearNuevoUsuario($tipoUsuario)
    {
        $nuevoUsuario = User::create(array(
            'tipo_usuario' => $tipoUsuario,
            'email'        => Input::get('email'),
            'password'     => Hash::make(Input::get('password'))
        ));

        return $nuevoUsuario;
    }
}
