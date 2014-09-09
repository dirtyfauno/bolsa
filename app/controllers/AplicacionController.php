<?php

/**
 * Class AplicacionController
 */
class AplicacionController extends \BaseController {

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vacante($id)
    {
        $user_id = Auth::user()->getAuthIdentifier();

        /** @var $aplicante AplicanteModel */
        $aplicante = AplicanteModel::where("user_id", $user_id)->firstOrFail();

        $vacante_id = VacanteModel::where("string_id", $id)->pluck("id");

        $aplicante->aplicaciones()->attach($vacante_id);

        return Redirect::back();
    }
}