<?php namespace Bolsa\Reportes;

use Carbon\Carbon;

/**
 * Class ReporteOpciones
 * @package Bolsa\Reportes
 */
class ReporteFechas {

	/**
	 * @var \Carbon\Carbon
	 */
	protected $inicio;
	/**
	 * @var \Carbon\Carbon
	 */
	protected $fin;
	/**
	 * @var array
	 */
	protected $arrayCarreras;


	/**
	 * @param Carbon $fecha_inicial
	 * @param Carbon $fecha_fin
	 * @param array  $carreras
	 */
	public function __construct(Carbon $fecha_inicial, Carbon $fecha_fin)
	{
		$this->inicio        = $fecha_inicial;
		$this->fin           = $fecha_fin;
	}


	/**
	 * @return array
	 */
	public function getArrayRango()
	{
		return array($this->inicio, $this->fin);
	}

	/**
	 * @return \Carbon\Carbon
	 */
	public function getMesInicio()
	{
		return $this->inicio;
	}

	/**
	 * @return \Carbon\Carbon
	 */
	public function getMesFin()
	{
		return $this->fin;
	}
}
