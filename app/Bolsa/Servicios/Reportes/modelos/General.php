<?php namespace Bolsa\Reportes\Modelos;

use Eloquent;

/**
 * Class General
 * @package Bolsa\Reportes\Modelos
 */
class General extends Eloquent {

    /**
     * @var string
     */
    protected $connection = 'reportes';
    /**
     * @var string
     */
    protected $table = 'general';
    /**
     * @var array
     */
    protected $fillable = array();
}