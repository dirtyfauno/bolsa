<?php namespace Bolsa\Presenters;

//use Carbon\Carbon;
use Laracasts\Presenter\Presenter;
use Str;

/**
 * Class VacantePresenter
 * @package Bolsa\Presenters
 */
class VacantePresenter extends Presenter {

    /**
     * @return mixed
     * @throws \Exception
     */
    public function titulado()
    {
        if (is_null($this->entity->titulado))
        {
            throw new \Exception('relacion \'titulado\' no existe');
        }

        if (is_null($this->entity->experiencia->nombre))
        {
            throw new \Exception('columna \'nombre\' no existe');
        }

        return $this->entity->titulado->nombre;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function experiencia()
    {
        if (is_null($this->entity->experiencia))
        {
            throw new \Exception('relacion \'experiencia\' no existe');
        }

        if (is_null($this->entity->experiencia->nombre))
        {
            throw new \Exception('columna \'nombre\' no existe');
        }

        return $this->entity->experiencia->nombre;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function vacante_id()
    {
        if (is_null($this->entity->id))
        {
            throw new \Exception('columna \'id\' no existe');
        }
        return $this->entity->id;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function contenido()
    {
        if (is_null($this->entity->contenido))
        {
            throw new \Exception('columna \'contenido\' no existe');
        }
        return $this->entity->contenido;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function cantidad_aplicantes()
    {
        if (is_null($this->aplicantes))
        {
            throw new \Exception('relacion \'aplicantes\' no existe');
        }

        return $this->aplicantes->count();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function tipo_vacante()
    {
        if (is_null($this->tipo->tipo))
        {
            throw new \Exception('columna \'tipo\' no existe');
        }

        return $this->tipo->tipo;
    }

    public function tipo_vacante_slug()
    {
        if (is_null($this->tipo->tipo))
        {
            throw new \Exception('columna \'tipo\' no existe');
        }

        return Str::slug($this->tipo->tipo);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function correo()
    {
        if (is_null($this->entity->correo))
        {
            throw new \Exception('columna \'correo\' no existe');
        }

        return $this->entity->correo;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function tipo_vacante_id()
    {
        if (is_null($this->tipo->tipo))
        {
            throw new \Exception('columna \'tipo_vacante\' no existe');
        }

        return $this->tipo->id;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function tipo_sueldo_id()
    {
        if (is_null($this->entity->tipo_sueldo))
        {
            throw new \Exception('columna \'tipo_sueldo\' no existe');
        }

        return $this->entity->tipo_sueldo;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function tipo_sueldo()
    {
        if (is_null($this->sueldo))
        {
            throw new \Exception('relación \'sueldo\' no existe');
        }

        return $this->sueldo->tipo;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function tipo_prestacion_id()
    {
        if (is_null($this->entity->tipo_prestacion))
        {
            throw new \Exception('columna \'tipo_prestacion\' no existe');
        }

        return $this->entity->tipo_prestacion;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function prestaciones()
    {
        if (is_null($this->entity->prestacion))
        {
            throw new \Exception('relación \'prestacion\' no existe');
        }

        return $this->entity->prestacion->tipo;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function tipo_estancia_id()
    {
        if (is_null($this->entity->tipo_estancia))
        {
            throw new \Exception('columna \'tipo_estancia\' no existe');
        }

        return $this->entity->tipo_estancia;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function estancia()
    {
        if (is_null($this->entity->estancia))
        {
            throw new \Exception('relación \'estancia\' no existe');
        }

        return $this->entity->estancia->tipo;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function nivel_ingles_id()
    {
        if (is_null($this->entity->nivel_ingles))
        {
            throw new \Exception('columna \'nivel_ingles\' no existe');
        }

        return $this->entity->nivel_ingles;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function nivel_ingles()
    {
        if (is_null($this->entity->ingles))
        {
            throw new \Exception('relación \'ingles\' no existe');
        }

        return $this->entity->ingles->nivel;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function keyword1()
    {
        if (is_null($this->entity->keyword1))
        {
            throw new \Exception('columna \'keyword1\' no existe');
        }

        return $this->entity->keyword1;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function keyword2()
    {
        if (is_null($this->entity->keyword2))
        {
            throw new \Exception('columna \'keyword2\' no existe');
        }

        return $this->entity->keyword2;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function id()
    {
        if (is_null($this->entity->string_id))
        {
            throw new \Exception('columna \'string_id\' no existe');
        }

        return $this->entity->string_id;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function titulo()
    {
        if (is_null($this->entity->titulo))
        {
            throw new \Exception('columna \'titulo\' no existe');
        }

        return Str::limit($this->entity->titulo, 40);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function tituloSlug()
    {
        if (is_null($this->entity->titulo))
        {
            throw new \Exception('columna \'titulo\' no existe');
        }

        return Str::slug($this->entity->titulo);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function carrera_nombre()
    {
        if (is_null($this->carrera->nombre))
        {
            throw new \Exception('columna \'nombre\' no existe');
        }

        return $this->carrera->nombre;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function carrera_id()
    {
        if (is_null($this->entity->carrera->id))
        {
            throw new \Exception('columna \'id\' no existe');
        }

        return $this->entity->carrera->id;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function empresa()
    {
        if (is_null($this->entity->empresa->nombre))
        {
            throw new \Exception('columna \'nombre\' no existe');
        }

        return Str::limit($this->entity->empresa->nombre, 19);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function empresa_id()
    {
        if (is_null($this->entity->empresa->id))
        {
            throw new \Exception('columna \'id\' no existe');
        }

        return $this->entity->empresa->id;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function empresaSlug()
    {
        if (is_null($this->entity->empresa->slug))
        {
            throw new \Exception('columna \'slug\' no existe');
        }

        return $this->entity->empresa->slug;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function carreraSlug()
    {
        if (is_null($this->entity->carrera->nombre))
        {
            throw new \Exception('columna \'nombre\' no existe');
        }

        return Str::slug($this->entity->carrera->nombre);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function oferta()
    {
        if (is_null($this->entity->oferta))
        {
            throw new \Exception('columna \'oferta\' no existe');
        }

        setlocale(LC_MONETARY, 'en_US.UTF-8');

        return money_format('%(#1n', $this->entity->oferta);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function oferta_int()
    {
        if (is_null($this->entity->oferta))
        {
            throw new \Exception('columna \'oferta\' no existe');
        }

        return $this->entity->oferta;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function fecha()
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
     * @return bool
     * @throws \Exception
     */
    public function rotar()
    {
        if (is_null($this->entity->rotar))
        {
            throw new \Exception('columna \'rotar\' no existe');
        }

        return $this->entity->rotar === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function viajar()
    {
        if (is_null($this->entity->viajar))
        {
            throw new \Exception('columna \'viajar\' no existe');
        }

        return $this->entity->viajar === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function prima()
    {
        if (is_null($this->entity->prima))
        {
            throw new \Exception('columna \'prima\' no existe');
        }

        return $this->entity->prima === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function vales()
    {
        if (is_null($this->entity->vales))
        {
            throw new \Exception('columna \'vales\' no existe');
        }

        return $this->entity->vales === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function transporte()
    {
        if (is_null($this->entity->transporte))
        {
            throw new \Exception('columna \'transporte\' no existe');
        }

        return $this->entity->transporte === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function residencia()
    {
        if (is_null($this->entity->residencia))
        {
            throw new \Exception('columna \'residencia\' no existe');
        }

        return $this->entity->residencia === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function aguinaldo()
    {
        if (is_null($this->entity->aguinaldo))
        {
            throw new \Exception('columna \'aguinaldo\' no existe');
        }

        return $this->entity->aguinaldo === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function comision()
    {
        if (is_null($this->entity->comision))
        {
            throw new \Exception('columna \'comision\' no existe');
        }

        return $this->entity->comision === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function seguro()
    {
        if (is_null($this->entity->seguro))
        {
            throw new \Exception('columna \'seguro\' no existe');
        }

        return $this->entity->seguro === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function comedor()
    {
        if (is_null($this->entity->comedor))
        {
            throw new \Exception('columna \'comedor\' no existe');
        }

        return $this->entity->comedor === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function viaticos()
    {
        if (is_null($this->entity->viaticos))
        {
            throw new \Exception('columna \'viaticos\' no existe');
        }

        return $this->entity->viaticos === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function gasolina()
    {
        if (is_null($this->entity->gasolina))
        {
            throw new \Exception('columna \'gasolina\' no existe');
        }

        return $this->entity->gasolina === "1";
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function honorarios()
    {
        if (is_null($this->entity->honorarios))
        {
            throw new \Exception('columna \'honorarios\' no existe');
        }

        return $this->entity->honorarios === "1";
    }
}
