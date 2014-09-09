<?php namespace Bolsa\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class VacanteRepositorio
 * @package Bolsa\Facades
 */
class VacanteRepositorio extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'job-repository';
    }
}
