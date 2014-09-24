<?php namespace Bolsa\Correo;

use Mail;
use TipoUsuarioModel;
use User;

/**
 * Class AdminMailer
 * @package Bolsa\Correo
 */
class AdminMailer extends Mailer {

    public function __construct()
    {
        /** @var $adminGeneral User */
        $adminGeneral = User::where("tipo_usuario", TipoUsuarioModel::ADMIN_GENERAL)->firstOrFail();

        Mail::alwaysFrom($adminGeneral->present()->correo, app('config')->get('mail.from.name'));
    }

    /**
     * @param       $empresa_mail
     * @param array $data
     */
    public function cuenta_desactivada($empresa_mail, array $data = array())
    {
        $vista = "correo.admin.cuenta_desactivada";

        $subject = "Bolsa de Trabajo - Cuenta Desactivada";

        $this->sent_to_email($empresa_mail, $subject, $vista, $data);
    }

    /**
     * @param       $empresa_mail
     * @param array $data
     */
    public function cuenta_activada($empresa_mail, array $data = array())
    {
        $vista = "correo.admin.cuenta_activada";

        $subject = "Bolsa de Trabajo - Cuenta Activada";

        $this->sent_to_email($empresa_mail, $subject, $vista, $data);
    }
}
