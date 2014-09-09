<?php

use Bolsa\Formularios\NuevaVacanteForm;

/**
 * Class VacanteController
 */
class VacanteController extends ApiBolsaController {

    /**
     * @var NuevaVacanteForm
     */
    protected $nuevaVacanteForm;

    /**
     * @param NuevaVacanteForm $registroEmpresa
     */
    public function __construct(NuevaVacanteForm $registroEmpresa)
    {
        $this->nuevaVacanteForm = $registroEmpresa;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function crear()
    {
        return View::make("test.vacante.crear");
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function nueva()
    {

        list($fail, $errores) = $this->crear_nueva_vacante($this->nuevaVacanteForm);

        if ($fail)
        {
            return Response::json(array(
                'success' => false,
                'errors'  => $errores->getErrors()->toArray(),
                'message' => "Error al crear nueva vacante"
            ));
        }

        return Response::json(array(
            'success' => true,
            'errors'  => null,
            'message' => 'Vacante Creada (:'
        ));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function actualizar($id)
    {
        list($fail, $errores) = $this->actualizar_vacante($id, $this->nuevaVacanteForm);

        if ($fail)
        {
            return Response::json(array(
                'success' => false,
                'errors'  => $errores->getErrors()->toArray(),
                'message' => "Error al crear nueva vacante"
            ));
        }

        return Response::json(array(
            'success' => true,
            'errors'  => null,
            'message' => "Vacante {$id} Editada (:"
        ));
    }

    /**
     *
     */
    protected function validarRegistroEmpresa()
    {
        $input = Input::all();

        $this->empresaForm->validate($input);
    }
}