<?php

/**
 * Class ZorroController
 */
class ZorroController extends \BaseController {

    /**
     * @return \Illuminate\View\View
     */
    public function registro()
    {
        $data = array(
            "carreras"      => array("null" => "Seleccionar Carrera") + CarreraModel::lists("nombre", "id"),
            "universidades" => array("null" => "Seleccionar Universidad") + UniversidadModel::lists("nombre", "id")
        );

        return View::make("desktop.zorro.registro", $data);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return View::make("desktop.zorro.alta_zorro");
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function alta()
    {
        return Redirect::back();
    }
}