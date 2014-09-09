<?php

use Laracasts\Presenter\Contracts\PresentableInterface;
use Laracasts\Presenter\PresentableTrait;

/**
 * Class CarreraModel
 */
class CarreraModel extends \Eloquent implements PresentableInterface {

    use PresentableTrait;

    /**
     *
     */
    const ARQUITECTURA = 1;
    /**
     *
     */
    const ELECTRICA = 2;
    /**
     *
     */
    const ELECTRONICA = 3;
    /**
     *
     */
    const GESTION = 4;
    /**
     *
     */
    const INDUSTRIAL = 5;
    /**
     *
     */
    const LOGISTICA = 6;
    /**
     *
     */
    const MATERIALES = 7;
    /**
     *
     */
    const MECANICA = 8;
    /**
     *
     */
    const MECATRONICA = 9;
    /**
     *
     */
    const SISTEMAS = 10;

    /**
     * @var array
     */
    protected $fillable = array("nombre", "slug");
    /**
     * @var string
     */
    protected $table = 'cat_carreras';
    /**
     * @var string
     */
    protected $presenter = 'Bolsa\Presenters\CarreraPresenter';
}