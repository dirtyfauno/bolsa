<?php namespace Bolsa\Presenters;

use Laracasts\Presenter\Presenter;

/**
 * Class CarreraPresenter
 * @package Bolsa\Presenters
 */
class CarreraPresenter extends Presenter {

    /**
     * @return mixed
     * @throws \Exception
     */
    public function nombre()
    {
        if (is_null($this->entity->nombre))
        {
            throw new \Exception('columna \'nombre\' no existe');
        }

        return $this->entity->nombre;
    }
}