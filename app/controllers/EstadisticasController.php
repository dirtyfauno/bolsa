<?php

use Bolsa\Servicios\EstadisticasVacantes;

/**
 * Class EstadisticasController
 */
class EstadisticasController extends \BaseController {

    /**
     * @param string $carrera
     * @return \Illuminate\View\View
     */
    public function index($carrera = "general")
    {
        $carreras = CarreraModel::lists('slug', "id");

        $carreras[] = "general";

        if (! in_array($carrera, $carreras))
        {
            return Redirect::route("estadisticas");
        }

        $estadisticas = new EstadisticasVacantes($carreras, app('log'));

//        return $e['programas'];
        /**
         * la configuración de esta dependencia
         * se encuentra en
         * 'app/config/packages/laracast/utilities/config.php'
         * + info: https://github.com/laracasts/PHP-Vars-To-Js-Transformer
         */
        JavaScript::put(array(
            'bolsa' => $estadisticas->meses(4)->tabla($carrera)->getEstadisticas()
        ));

        $data = array("carreras" => CarreraModel::all());

        return View::make('test.jamon', $data);
    }
}