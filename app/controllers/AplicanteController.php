<?php

use Bolsa\Formularios\ActualizarAplicanteForm;
use Laracasts\Validation\FormValidationException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * Class AplicanteController
 */
class AplicanteController extends \BaseController {

    /**
     * @var ActualizarAplicanteForm
     */
    protected $aplicanteForm;

    /**
     * @param ActualizarAplicanteForm $aplicanteForm
     */
    public function __construct(ActualizarAplicanteForm $aplicanteForm)
    {
        $this->aplicanteForm = $aplicanteForm;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function cv()
    {
        $id = Auth::getUser()->id;

        $user = User::with("aplicante")->findOrFail($id);

        try
        {
            $file = cv_path() . $user->aplicante->cv;
            return  Response::download($file);
        }
        catch (Exception $e)
        {
            Log::error($e->getMessage());

            Flash::error("Hubo un problema, por favor intenta más tarde");
            return Redirect::route("aplicante.inicio");
        }
    }

    /**
     * Display a listing of the resource.
     * GET /aplicante
     *
     * @return Response
     */
    public function inicio()
    {
        $id = Auth::user()->getAuthIdentifier();

        /** @var $aplicante AplicanteModel */
        $aplicante = AplicanteModel::with(array("aplicaciones.empresa", "carrera_relacion"))->where("user_id", $id)->first();

        /** @var $aplicaciones Illuminate\Pagination\Paginator */
        $aplicaciones = $aplicante->aplicaciones()->paginate(3);

        $data = array(
            "vacantes_f_c"  => (int) VacanteModel::where("tipo_id", TipoVacanteModel::FORMAL)->where("carrera_id", $aplicante->present()->carrera_id)->count(),
            "vacantes_p_c"  => (int) VacanteModel::where("tipo_id", TipoVacanteModel::PRACTICANTE)->where("carrera_id", $aplicante->present()->carrera_id)->count(),
            "aplicante"     => $aplicante,
            "aplicaciones"  => $aplicaciones,
            "carreras"      => CarreraModel::lists("nombre", "id"),
            "universidades" => UniversidadModel::lists("nombre", "id")
        );
        return View::make("responsive.aplicante.inicio", $data);
    }

    /**
     * Update the specified resource in storage.
     * PUT /aplicante/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id = null)
    {
//        return Input::all();
        $id = Input::get("aplicante_id");

        try
        {
            $this->aplicanteForm->validate(Input::all());
        }
        catch (FormValidationException $e)
        {
            Flash::error("Hubo un problema con tus datos, corrígelos por favor.");
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        /** @var $aplicante AplicanteModel */
        $aplicante = AplicanteModel::findOrFail($id);

        if (Input::hasFile("cv"))
        {
            try
            {
                $cv_name = $aplicante->id . "a_" . Str::random(6) . "." . Input::file("cv")->getClientOriginalExtension();

                Input::file('cv')->move(cv_path(), $cv_name);

                File::delete(cv_path() . $aplicante->cv);

                $aplicante->update(array(
                    "cv" => $cv_name
                ));
            }
            catch (FileException $e)
            {
                Log::error("error al subir cv del usuario {$aplicante->id}: al directorio de cv, checar permisos del directorio.");
                Log::error($e->getMessage());

                Flash::error("Hubo un problema con tu currículum, intenta de nuevo.");
                return Redirect::back()->withInput();
            }
        }

        $aplicante->update(array(
            "nombre"         => Input::get("nombre"),
            "carrera"        => (int) Input::get("carrera"),
            "universidad_id" => (int) Input::get("universidad_id"),
            "matricula"      => Input::get("matricula"),
            "mailing"        => (int) Input::get("mailing") == 1 ? true : false
        ));

        Flash::success("Datos Actualizados");
        return Redirect::back();
    }
}