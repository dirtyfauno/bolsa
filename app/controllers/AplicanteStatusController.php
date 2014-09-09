<?php

/**
 * Class AplicanteStatusController
 */
class AplicanteStatusController extends \BaseController {

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function desactivar()
    {
        $id = (int) Input::get("aplicante_id");

        /** @var $aplicante Eloquent */
        $aplicante = AplicanteModel::findOrFail($id);

        // desactivar aplicante
        $aplicante->delete();

        Flash::warning("Aplicante <strong>{$aplicante->present()->nombre}</strong> ha sido desactivad@");

        return Redirect::back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activar()
    {
        $id = (int) Input::get("aplicante_id");

        /** @var $aplicante Eloquent */
        $aplicante = AplicanteModel::onlyTrashed()->findOrFail($id);

        // activar aplicante
        $aplicante->restore();

        Flash::success("Aplicante <strong>{$aplicante->present()->nombre}</strong> ha sido reactivad@");

        return Redirect::back();
    }
}