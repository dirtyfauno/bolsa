<?php namespace Bolsa\Formularios;

use Laracasts\Validation\FormValidator;

/**
 * Class IngresoForm
 * @package Bolsa\Formularios
 */
class IngresoForm extends FormValidator {

    /**
     * @var array
     */
    protected $rules = array(
			'email'    => 'required|email',
			'password' => 'required');
}