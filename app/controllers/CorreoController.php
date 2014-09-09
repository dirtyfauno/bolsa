<?php

use Bolsa\Correo\EmpresaMailer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class CorreoController
 */
class CorreoController extends \BaseController {

    /**
     * @var EmpresaMailer
     */
    protected $empresa_mailer;

    /**
     * @param EmpresaMailer $empresa_mailer
     */
    public function __construct(EmpresaMailer $empresa_mailer)
    {
        $this->empresa_mailer = $empresa_mailer;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function empresa_feedback()
    {
        // verificar sesion, esto puede ser un filtro mejor
        if (! Auth::check())
        {
            Log::alert("empresa desea enviar feedback pero no esta en sesión");

            return Redirect::route('bolsa.inicio');
        }

        // verificar que sea empresa
        $user_id = Auth::user()->getAuthIdentifier();

        try
        {
            $empresa = EmpresaModel::with('reclutador')->where('user_id', $user_id)->firstOrFail();
        }
        catch (ModelNotFoundException $e)
        {
            Log::alert("no empresa intento enviar feedback, user: {$user_id}");

            return Redirect::route('bolsa.inicio');
        }

        // verificar mensaje en blanco
        if (Input::get('feedback') == "")
        {
            return Redirect::back()->with('error_feedback', 'No hay nada escrito');
        }

        $correo = $empresa->present()->correo;

        $data = array(
            'empresa'  => $empresa,
            'feedback' => Input::get('feedback')
        );

        try
        {
            $this->empresa_mailer->enviar_feedback($correo, $data);
        }
        catch (Swift_TransportException $e)
        {
            Log::error($e->getMessage());
            return Redirect::route('empresa.inicio')->with('mensaje', 'Error al enviar feedback, intenta de nuevo.');
        }

        return Redirect::route('empresa.inicio')->with('mensaje', 'Feedback enviado');
    }
}
