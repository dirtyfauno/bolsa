<?php

use Laracasts\Presenter\Contracts\PresentableInterface;
use Laracasts\Presenter\PresentableTrait;

/**
 * Class AplicanteModel
 */
class AplicanteModel extends \Eloquent implements PresentableInterface {

    use PresentableTrait;

    /**
     * @var array
     */
    protected $fillable = array(
        "user_id",
        "nombre",
        "carrera",
        "universidad_id",
        "matricula",
        "mailing",
        "cv"
    );

    /**
     * @var string
     */
    protected $table = "aplicantes";

    /**
     * @var bool
     */
    protected $softDelete = true;

    /**
     * @var string
     */
    protected $presenter = 'Bolsa\Presenters\AplicantePresenter';

    /**
     * Eventos
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function (AplicanteModel $model)
        {
        });

        static::deleted(function (AplicanteModel $model)
        {
            // soft-delete
            $model->user()->delete();
        });

        static::restored(function (AplicanteModel $model)
        {
            // reactivar user
            $model->user()->restore();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("User", "user_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrera_relacion()
    {
        return $this->belongsTo("CarreraModel", "carrera");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function universidad()
    {
        return $this->belongsTo("UniversidadModel", "universidad_id");
    }

    /**
     * @return mixed
     */
    public function aplicaciones()
    {
        return $this->belongsToMany('VacanteModel', 'aplicante_vacante', 'aplicante_id', 'vacante_id')
            ->withTimestamps()->orderBy("aplicante_vacante.created_at", "desc");
    }
}