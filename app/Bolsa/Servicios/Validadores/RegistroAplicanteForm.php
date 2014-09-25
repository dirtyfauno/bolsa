<?php namespace Bolsa\Formularios;

use Laracasts\Validation\FormValidator;

/**
 * Class RegistroAplicanteForm
 * @package Bolsa\Formularios
 */
class RegistroAplicanteForm extends FormValidator {

    /**
     * @var array
     */
    protected $rules = array(
        'nombre'         => 'required',
        'carrera'        => 'required|exists:cat_carreras,id',
        'universidad_id' => 'required|exists:cat_universidades,id',
        'matricula'      => 'required',
        'email'          => 'email|required|unique:users',
        'cv'             => 'required|max:1024|mimes:pdf,doc,docx',
        'password'       => 'required|alpha_num|min:8|confirmed'
    );
}
