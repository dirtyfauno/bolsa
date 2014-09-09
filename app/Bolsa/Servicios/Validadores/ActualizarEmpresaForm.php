<?php namespace Bolsa\Formularios;

use Laracasts\Validation\FormValidator;

/**
 * Class ActualizarEmpresaForm
 * @package Bolsa\Formularios
 */
class ActualizarEmpresaForm extends FormValidator {

    /**
     * @var array
     */
    protected $rules = array(
        'nombre'     => 'required|unique:empresas,slug',
        'direccion'  => 'required',
        'giro'       => 'required',
        'telefono'   => 'required',
        'logo'       => 'required|mimes:png,jpg,jpeg|max:1000'
    );
}