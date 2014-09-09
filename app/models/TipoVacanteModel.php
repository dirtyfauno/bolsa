<?php

/**
 * Class TipoVacanteModel
 */
class TipoVacanteModel extends \Eloquent {

    /**
     *
     */
    const PRACTICANTE = 2;
    /**
     *
     */
    const FORMAL = 1;
    /**
     * @var array
     */
    protected $fillable = array();
    /**
     * @var string
     */
    protected $table = "cat_vacantes";
}