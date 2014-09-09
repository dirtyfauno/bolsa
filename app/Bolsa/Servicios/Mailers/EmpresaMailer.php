<?php namespace Bolsa\Correo;

/**
 * Class EmpresaMailer
 * @package Bolsa\Correo
 */
class EmpresaMailer extends Mailer {

    /**
     * @param       $empresa_mail
     * @param array $data
     */
    public function enviar_feedback($empresa_mail, array $data = array())
    {
        $vista = "correo.empresa.enviar_feedback";

        $subject = "Bolsa de Trabajo - Reclutador ha enviado Feedback";

        $this->sent_feedback($empresa_mail, $subject, $vista, $data);
    }

    /**
     * @param       $empresa_mail
     * @param array $data
     */
    public function cuenta_desactivada($empresa_mail, array $data = array())
    {
        $vista = "correo.empresa.cuenta_desactivada";

        $subject = "Bolsa de trabajo - Cuenta Desactivada";

        $this->sent_to_email($empresa_mail, $subject, $vista, $data);
    }

    /**
     * @param       $empresa_mail
     * @param array $data
     */
    public function cuenta_activada($empresa_mail, array $data = array())
    {
        $vista = "correo.empresa.cuenta_activada";

        $subject = "Bolsa de Trabajo - Cuenta Activada";

        $this->sent_to_email($empresa_mail, $subject, $vista, $data);
    }
}
