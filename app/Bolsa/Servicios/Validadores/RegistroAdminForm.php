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
        'password'       => 'required|alpha_num|min:8'
    );
}
