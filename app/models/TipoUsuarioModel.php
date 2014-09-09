<?php

/**
 * Class TipoUsuarioModel
 */
class TipoUsuarioModel extends \Eloquent {

    /**
     *
     */
    const ADMIN = 1;
    /**
     *
     */
    const RECLUTADOR = 2;
    /**
     *
     */
    const APLICANTE = 3;
    /**
     *
     */
    const ADMIN_GENERAL = 4;

    /**
     * @var array
     */
    protected $fillable = array();
    /**
     * @var string
     */
    protected $table = 'cat_usuarios';
}