<?php

namespace spec\Bolsa\Servicios;

use Bolsa\Servicios\EstadisticasVacantes;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EstadisticasVacantesSpec extends ObjectBehavior {

	protected $carreras;

	function let($log)
	{
		$this->carreras = array('sistemas', 'mecatronica');
    $log->beADoubleOf("Illuminate\\Log\\Writer");
		$this->beConstructedWith($this->carreras, $log);
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('Bolsa\Servicios\EstadisticasVacantes');
	}

	function it_establece_el_numero_de_meses_para_tomar_datos(EstadisticasVacantes $ev)
	{
		$this->meses(Argument::type('int'))
		     ->shouldReturnAnInstanceOf('Bolsa\Servicios\EstadisticasVacantes');
	}

	function it_realiza_queries_para_obtener_datos()
	{
		$param = $this->carreras[array_rand($this->carreras)];
		$this->tabla($param)
		     ->shouldReturnAnInstanceOf('Bolsa\Servicios\EstadisticasVacantes');
	}

}
