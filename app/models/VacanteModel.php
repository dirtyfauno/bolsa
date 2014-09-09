<?php

use Laracasts\Presenter\Contracts\PresentableInterface;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class VacanteModel
 */
class VacanteModel extends Eloquent implements PresentableInterface {

    use PresentableTrait;

    /**
     *
     */
    const ACTIVA = 1;

    /**
     *
     */
    const CERRADA = 0;

    /**
     * @var string
     */
    protected $table = "vacantes";

    /**
     * @var bool
     */
    protected $softDelete = true;

    /**
     * @var string
     */
    protected $presenter = 'Bolsa\Presenters\VacantePresenter';

    /**
     * @var array
     */
    protected $fillable = array(
        'string_id',
        "status",
        'empresa_id',
        'correo',
        'carrera_id',
        "mailed",
        "puesto",
        "titulado_id",
        "experiencia_id",
        "tipo_id",
        'area',
        'software',
        'oferta',
        'ingles_id',
        "rotar",
        "viajar",
        "prima",
        "vales",
        "transporte",
        "residencia",
        "aguinaldo",
        "comision",
        "seguro",
        "comedor",
        "viaticos",
        "gasolina",
        "honorarios",
        "titulo",
        "contenido"
    );

    # Relaciones
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function aplicantes()
    {
        return $this->belongsToMany('AplicanteModel', 'aplicante_vacante', 'vacante_id', 'aplicante_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrera()
    {
        return $this->belongsTo('CarreraModel', 'carrera_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo('EmpresaModel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo()
    {
        return $this->belongsTo('TipoVacanteModel', 'tipo_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ingles()
    {
        return $this->belongsTo('NivelInglesModel', 'ingles_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function experiencia()
    {
        return $this->belongsTo('ExperienciaModel', 'experiencia_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function titulado()
    {
        return $this->belongsTo('TituladoModel', 'titulado_id');
    }
}