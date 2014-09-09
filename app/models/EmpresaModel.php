<?php

use Bolsa\Correo\EmpresaMailer;
use Laracasts\Presenter\PresentableTrait;

/**
 * Class EmpresaModel
 */
class EmpresaModel extends \Eloquent {

    use PresentableTrait;

    /**
     *
     */
    const PENDIENTE = 0;

    /**
     *
     */
    const ACTIVA = 1;

    /**
     *
     */
    const DESACTIVADA = 2;

    /**
     *
     */
    const RECHAZADA = 3;

    /**
     * @var array
     */
    protected $fillable = array(
        'user_id',
        "status",
        'nombre',
        "reclutador_nombre",
        'giro',
        "rfc",
        'logo',
        'telefono',
        'direccion',
        'slug'
    );

    /**
     * @var string
     */
    protected $table = 'empresas';

    /**
     * @var bool
     */
    protected $softDelete = true;

    /**
     * @var string
     */
    protected $presenter = 'Bolsa\Presenters\EmpresaPresenter';

    /**
     * Eventos
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function (EmpresaModel $model)
        {
            if ($model->present()->status_int !== self::PENDIENTE)
            {
                $model->update(array(
                    "status" => self::DESACTIVADA
                ));
            }
        });

        static::deleted(function (EmpresaModel $model)
        {
            // soft-delete vacantes
            $model->vacantes()->delete();

            // soft-delete usuario
            $model->reclutador()->delete();
        });

        static::restored(function (EmpresaModel $model)
        {
            // restaurar user
            $model->reclutador()->restore();

            $model->update(array(
                "status" => self::ACTIVA
            ));

            // retaurar vacantes
            $model->vacantes()->restore();

            // mantener vacantes cerradas
            $model->vacantes()->where("status", VacanteModel::CERRADA)->get()->each(function (VacanteModel $v)
            {
                $v->delete();
            });
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vacantes()
    {
        return $this->hasMany('VacanteModel', 'empresa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reclutador()
    {
        return $this->belongsTo('User', 'user_id');
    }
}
