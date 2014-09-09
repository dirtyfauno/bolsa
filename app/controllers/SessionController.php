<?php

use Bolsa\Formularios\IngresoForm;
use Laracasts\Validation\FormValidationException;

/**
 * Class SessionController
 */
class SessionController extends \BaseController {

    /**
     * @var IngresoForm
     */
    protected $ingreso_form;

    /**
     * @param IngresoForm $registroEmpresa
     */
    function __construct(IngresoForm $registroEmpresa)
    {
        $this->ingreso_form = $registroEmpresa;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function ingreso()
    {
        try
        {
            $input = Input::only('email', 'password');
            $this->ingreso_form->validate($input);
        }
        catch (FormValidationException $e)
        {
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        # aqui sólo redirigimos a los reclutadores y al admin
        # los egresados ó estudiante me imagino querrán ver las vacantes
        //    dd($input);
        if (Auth::attempt($input))
        {
            # getTipoUsuario
            # es un miembro definido en la clase 'User' (modelo)
            $tipoUsuario = Auth::user()->getTipoUsuario();

            if ($tipoUsuario == TipoUsuarioModel::RECLUTADOR
            )
            {
                return Redirect::route('empresa.inicio');
            }

            if ($tipoUsuario == TipoUsuarioModel::ADMIN
            )
            {
                return Redirect::route('admin.inicio');
            }

            return Redirect::route('bolsa.inicio');
        }

        return Redirect::back()->withInput()->with('alerta', 'Credenciales Inválidas.');
    }

    /**
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id = null)
    {
        Auth::logout();
        Session::clear();
        return Redirect::route('bolsa.inicio');
    }
}