<?php namespace Bolsa\Formularios;

use Laracasts\Validation\FormValidator;

/**
 * Class RegistroAdminForm
 * @package Bolsa\Formularios
 */
class RegistroAdminForm extends FormValidator {

    /**
     * @var array
     */
    protected $rules = array(
        'email'          => 'required|email|unique:users',
        'password'       => 'Required|Between:8,32|Regex:/^([a-z0-9!@#$€£%^&*_+-])+$/i'
    );
}
