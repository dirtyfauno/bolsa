<?php

/**
 * Class TituladoModel
 */
class TituladoModel extends \Eloquent {

    /**
     * @var array
     */
    protected $fillable = array("nombre", "slug");
    /**
     * @var string
     */
    protected $table = "cat_titulado";
}