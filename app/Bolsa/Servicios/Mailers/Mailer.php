<?php namespace Bolsa\Correo;

use Bolsa\Contracts\Notifiable;
use Mail;
use TipoUsuarioModel;
use User;

/**
 * Class Mailer
 * @package Bolsa\Correo
 */
abstract class Mailer {

    /**
     * @param Notifiable $usuario
     * @param            $subject
     * @param            $vista
     * @param array      $data
     */
    protected function sent_to(Notifiable $usuario, $subject, $vista, array $data)
    {
        Mail::send($vista, $data, function ($correo) use ($usuario, $subject)
        {
            $correo->to($usuario->getEmail())->subject($subject);
        });
    }

    /**
     * @param       $email
     * @param       $subject
     * @param       $vista
     * @param array $data
     */
    protected function sent_to_email($email, $subject, $vista, array $data = array())
    {
        Mail::send($vista, $data, function ($correo) use ($email, $subject)
        {
            $correo->to($email)->subject($subject);
        });
    }

    /**
     * @param       $emisor
     * @param       $subject
     * @param       $vista
     * @param array $data
     */
    protected function sent_feedback($emisor, $subject, $vista, array $data)
    {

        setlocale(LC_TIME, 'es_ES'); // para la fecha en español

        /** @var $adminGeneral User */
        $adminGeneral = User::where("tipo_usuario", TipoUsuarioModel::ADMIN_GENERAL)->firstOrFail();

        Mail::send($vista, $data, function ($correo) use ($emisor, $subject, $adminGeneral)
        {
            $correo->from($emisor)->subject($subject);

            $correo->to($adminGeneral->present()->correo);
        });
    }
}