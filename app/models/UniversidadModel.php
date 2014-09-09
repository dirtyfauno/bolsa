<?php

/**
 * Class UniversidadModel
 */
class UniversidadModel extends \Eloquent {

    /**
     * @var array
     */
    protected $fillable = array("nombre", "slug");
    /**
     * @var string
     */
    protected $table = 'cat_universidades';
}