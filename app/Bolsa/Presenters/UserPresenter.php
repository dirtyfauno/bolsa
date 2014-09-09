<?php namespace Bolsa\Presenters;

use Laracasts\Presenter\Presenter;

/**
 * Class UserPresenter
 * @package Bolsa\Presenters
 */
class UserPresenter extends Presenter {

    /**
     * @return mixed
     * @throws \Exception
     */
    public function correo()
    {
        if (is_null($this->entity->email))
        {
            throw new \Exception('columna \'email\' no existe');
        }

        return $this->entity->email;
    }
}