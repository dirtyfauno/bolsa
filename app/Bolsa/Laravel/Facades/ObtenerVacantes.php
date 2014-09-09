<?php namespace Bolsa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ObtenerVacantes
 * @package Bolsa\Facades
 */
class ObtenerVacantes extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bolsa.obtener-vacantes';
    }
}