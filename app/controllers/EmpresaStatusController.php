<?php

use Bolsa\Correo\EmpresaMailer;

/**
 * Class EmpresaStatusController
 */
class EmpresaStatusController extends \BaseController {

    /**
     * @var EmpresaMailer
     */
    protected $empresaMailer;

    /**
     * @param EmpresaMailer $empresaMailer
     */
    public function __construct(EmpresaMailer $empresaMailer)
    {
        $this->empresaMailer = $empresaMailer;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function desactivar()
    {
        $id = (int) Input::get("empresa_id");

        /** @var $empresa Eloquent */
        $empresa = EmpresaModel::withTrashed()->with(array(
        "reclutador" => function ($query)
        {
            $query->withTrashed();
        }
        ))->findOrFail($id);

        // soft-delete empresa
        $empresa->delete();

        // enviar correo de desactivación
        $this->empresaMailer->cuenta_desactivada($empresa->present()->correo);

        Flash::success("La empresa <strong>{$empresa->present()->nombre}</strong> ha sido desactivada");

        return Redirect::back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activar()
    {
        $id = (int) Input::get("empresa_id");

        $empresa = EmpresaModel::onlyTrashed()->findOrFail($id);

        $empresa->restore();

        // enviar correo de activación
        $this->empresaMailer->cuenta_activada($empresa->present()->correo);

        Flash::success("La empresa <strong>{$empresa->present()->nombre}</strong> ha sido activada");

        return Redirect::back();
    }
}