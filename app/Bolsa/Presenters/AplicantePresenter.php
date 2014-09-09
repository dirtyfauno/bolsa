<?php namespace Bolsa\Presenters;

use Laracasts\Presenter\Presenter;

/**
 * Class AplicantePresenter
 * @package Bolsa\Presenters
 */
class AplicantePresenter extends Presenter {

    /**
     * @return string
     * @throws \Exception
     */
    public function actualizado()
    {
        if (is_null($this->entity->updated_at))
        {
            throw new \Exception('columna \'updated_at\' no existe');
        }

        setlocale(LC_TIME, 'es_ES');
        // los modelos eloquent manejan convenientemente las fechas como instancias de
        // 'Carbon' => https://github.com/briannesbitt/Carbon
        return ucwords($this->entity->updated_at->formatLocalized('%d %b %Y'));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function fecha_registro()
    {
        if (is_null($this->entity->created_at))
        {
            throw new \Exception('columna \'created_at\' no existe');
        }
        return $this->entity->created_at;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function matricula()
    {
        if (is_null($this->entity->matricula))
        {
            throw new \Exception('columna \'matricula\' no existe');
        }
        return $this->entity->matricula;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function universidad()
    {
        if (is_null($this->entity->universidad->nombre))
        {
            throw new \Exception('columna \'nombre\' no existe');
        }
        return $this->entity->universidad->nombre;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function mailing()
    {
        if (is_null($this->entity->mailing))
        {
            throw new \Exception('columna \'mailing\' no existe');
        }
        if ($this->entity->mailing == "0")
        {
            return false;
        }
        return true;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function carrera_nombre()
    {
        if (is_null($this->entity->carrera_relacion->nombre))
        {
            throw new \Exception('columna \'nombre\' no existe');
        }
        return $this->entity->carrera_relacion->nombre;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function carrera_slug()
    {
        if (is_null($this->entity->carrera_relacion->slug))
        {
            throw new \Exception('columna \'slug\' no existe');
        }
        return $this->entity->carrera_relacion->slug;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function carrera_id()
    {
        if (is_null($this->entity->carrera))
        {
            throw new \Exception('columna \'carrera\' no existe');
        }
        return $this->entity->carrera;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function correo()
    {
        $this->verificar_relacion_usuario();

        if (is_null($this->entity->user->email))
        {
            throw new \Exception('columna \'email\' no existe');
        }

        return $this->entity->user->email;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function nombreCompleto()
    {
        if (is_null($this->entity->nombre))
        {
            throw new \Exception('columna \'nombre\' no existe');
        }

        return $this->entity->nombre;
    }

    /**
     * @throws \Exception
     */
    private function verificar_relacion_usuario()
    {
        if (is_null($this->entity->user))
        {
            throw new \Exception('relación \'user\' no existe');
        }
    }
}