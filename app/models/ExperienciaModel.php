<?php

/**
 * Class ExperienciaModel
 */
class ExperienciaModel extends \Eloquent {

    /**
     * @var array
     */
    protected $fillable = array("nombre", "slug");
    /**
     * @var string
     */
    protected $table = "cat_experiencia";
}