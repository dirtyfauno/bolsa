<?php namespace Bolsa\Formularios;

use Laracasts\Validation\FormValidator;

/**
 * Class RegistroEmpresaForm
 * @package Bolsa\Formularios
 */
class RegistroEmpresaForm extends FormValidator {

    /**
     * @var array
     */
    protected $rules = array(
        'nombre'             => 'required|unique:empresas,slug',
        'reclutador_nombre' => 'required',
        'direccion'          => 'required',
        'giro'               => 'required',
        'telefono'           => 'required',
        'email'              => 'email|required|unique:users',
        'rfc'                => 'required',
        'logo'               => 'required|image|mimes:png,jpg,jpeg|max:1000',
        'password'           => 'required|confirmed'
    );
}