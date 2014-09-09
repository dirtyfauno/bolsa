<?php namespace Bolsa\Formularios;

use Laracasts\Validation\FormValidator;

/**
 * Class NuevaVacanteForm
 * @package Bolsa\Formularios
 */
class NuevaVacanteForm extends FormValidator {

    /**
     * @var array
     */
    protected $rules = array(
        'carrera_id'     => 'required|exists:cat_carreras,id',
        'correo'         => 'required|email',
        'experiencia_id' => 'required|exists:cat_experiencia,id',
        'ingles_id'      => 'required|exists:cat_ingles,id',
        'puesto'         => 'required|max:40',
        'software'       => 'required|max:40',
        'oferta'         => 'required|integer',
        'tipo_id'        => 'required|exists:cat_vacantes,id',
        'titulado_id'    => 'required|exists:cat_titulado,id',
        'titulo'         => 'required|max:40',
        'contenido'      => 'required',
        'area'           => 'required'
    );
}
