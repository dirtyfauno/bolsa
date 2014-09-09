<?php namespace Bolsa\Presenters;

use EmpresaModel;
use Laracasts\Presenter\Presenter;

/**
 * Class EmpresaPresenter
 * @package Bolsa\Presenters
 */
class EmpresaPresenter extends Presenter {

    /**
     * @return mixed
     * @throws \Exception
     */
    public function reclutador()
    {
        if (is_null($this->entity->reclutador_nombre))
        {
            throw new \Exception('columna \'reclutador_nombre\' no existe');
        }

        return $this->entity->reclutador_nombre;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function status_int()
    {
        if (is_null($this->entity->status))
        {
            throw new \Exception('columna \'status\' no existe');
        }

        return $this->entity->status;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function status()
    {
        if (is_null($this->entity->status))
        {
            throw new \Exception('columna \'status\' no existe');
        }

        if ($this->entity->status == EmpresaModel::ACTIVA)
        {
            return "Empresa Activa";
        }
        if ($this->entity->status == EmpresaModel::RECHAZADA)
        {
            return "Empresa Rechazada";
        }

        if ($this->entity->status == EmpresaModel::DESACTIVADA)
        {
            return "Empresa Desactivada";
        }

        return "Empresa Pendiente";
    }

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

    /**
     * @return mixed
     * @throws \Exception
     */
    public function giro()
    {
        if (is_null($this->entity->giro))
        {
            throw new \Exception('columna \'giro\' no existe');
        }

        return $this->entity->giro;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function telefono()
    {
        if (is_null($this->entity->telefono))
        {
            throw new \Exception('columna \'telefono\' no existe');
        }

        return $this->entity->telefono;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function correo()
    {
        if (is_null($this->reclutador))
        {
            throw new \Exception('relacion \'reclutador\' no existe');
        }

        if (is_null($this->entity->reclutador->email))
        {
            throw new \Exception('columna \'email\' no existe');
        }

        return $this->entity->reclutador->email;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function correoReclutador()
    {
        if (is_null($this->entity->reclutador->email))
        {
            throw new \Exception('columna \'email\' no existe');
        }

        return trim($this->entity->reclutador->email);
    }
}