<?php namespace Bolsa\Formularios;

use Laracasts\Validation\FormValidator;

/**
 * Class ActualizarAplicanteForm
 * @package Bolsa\Formularios
 */
class ActualizarAplicanteForm extends FormValidator {

    /**
     * @var array
     */
    protected $rules = array(
        'nombre'         => 'required',
        'carrera'        => 'required|exists:cat_carreras,id',
        'universidad_id' => 'required|exists:cat_universidades,id',
        'matricula'      => 'required',
        'cv'             => 'mimes:pdf,doc,docx|max:1024',
    );
}