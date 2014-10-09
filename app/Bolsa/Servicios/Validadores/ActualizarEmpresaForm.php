<?php namespace Bolsa\Formularios;

use EmpresaModel;
use Laracasts\Validation\FormValidator;

/**
 * Class ActualizarEmpresaForm
 * @package Bolsa\Formularios
 */
class ActualizarEmpresaForm extends FormValidator
{
    /**
     * @var array
     */
    protected $rules = array(
        'direccion' => 'required',
        'giro' => 'required',
        'telefono' => 'required',
        'logo' => 'required|mimes:png,jpg,jpeg|max:1000'
    );

    /**
     * @param $id
     * @return $this
     */
    public function excluirUser($id)
    {
        $user_id = EmpresaModel::where("user_id", $id)->pluck("id");
        $this->rules['nombre'] = "required|unique:empresas,slug,$user_id";

        return $this;
    }
}