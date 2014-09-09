<?php

namespace Bolsa;

use Bolsa\Entities\Job\Contracts\JobRepositoryInterface;

/**
 * Class ObtenerVacantes
 * @package Bolsa
 */
class ObtenerVacantes {

    /**
     *
     */
    const TIPO_FORMAL      = 1;
    /**
     *
     */
    const TIPO_PRACTICANTE = 2;
    /**
     * @var JobRepositoryInterface
     */
    protected $jobRepo;

    /**
     * @param JobRepositoryInterface $jobRepo
     */
    function __construct(JobRepositoryInterface $jobRepo)
	{
		$this->jobRepo = $jobRepo;
	}

	/**
	 * @param $vacante_id
	 *
	 * @return array
	 */
	public function por_id($vacante_id)
	{
		list($vacante, $fail) = $this->jobRepo->get_single_job($vacante_id);

		if ($fail)
		{
			return array(null, true);
		}

		return array($vacante, false);
	}

    /**
     * @param $empresa_id
     * @param int $pagina
     * @param int $por_pagina
     */
    public function todas_por_empresa($empresa_id, $pagina = 1, $por_pagina = 10)
	{
		$this->jobRepo->get_all_jobs_by_author($empresa_id, $pagina, $por_pagina);
	}

    /**
     * @param $empresa_id
     * @param int $pagina
     * @param int $por_pagina
     * @return mixed
     */
    public function activas_por_empresa($empresa_id, $pagina = 1, $por_pagina = 10)
	{
		return $this->jobRepo->get_active_jobs_by_author($empresa_id, $pagina, $por_pagina);
	}

    /**
     * @param $empresa_id
     * @param int $pagina
     * @param int $por_pagina
     * @return mixed
     */
    public function cerradas_por_empresa($empresa_id, $pagina = 1, $por_pagina = 10)
	{
		return $this->jobRepo->get_closed_jobs_by_author($empresa_id, $pagina, $por_pagina);
	}

    /**
     * @param int $pagina
     * @param int $por_pagina
     * @return mixed
     */
    public function formales($pagina = 1, $por_pagina = 10)
	{
		return $this->jobRepo->get_active_jobs($pagina, $por_pagina, self::TIPO_FORMAL);
	}

    /**
     * @param $empresa_id
     * @param int $pagina
     * @param int $por_pagina
     * @return mixed
     */
    public function formales_por_empresa($empresa_id, $pagina = 1, $por_pagina = 10)
	{
		return $this->jobRepo->get_active_jobs_by_author($empresa_id, $pagina, $por_pagina, self::TIPO_FORMAL);
	}

    /**
     * @param $carrera_id
     * @param int $pagina
     * @param int $por_pagina
     * @return mixed
     */
    public function formales_por_carrera($carrera_id, $pagina = 1, $por_pagina = 10)
	{
		return $this->jobRepo->get_active_jobs_by_subkind($carrera_id, $pagina, $por_pagina, self::TIPO_FORMAL);
	}

    /**
     * @param $keyword
     * @param $carrera_id
     * @param int $pagina
     * @param int $por_pagina
     * @return mixed
     */
    public function formales_por_keyword($keyword, $carrera_id, $pagina = 1, $por_pagina = 10)
	{
		return $this->jobRepo->get_active_jobs_by_keyword($keyword, $carrera_id, $pagina, $por_pagina, self::TIPO_FORMAL);
	}

    /**
     * @param int $pagina
     * @param int $por_pagina
     * @return mixed
     */
    public function practicantes($pagina = 1, $por_pagina = 10)
	{
		return $this->jobRepo->get_active_jobs($pagina, $por_pagina, self::TIPO_PRACTICANTE);
	}

    /**
     * @param $empresa_id
     * @param int $pagina
     * @param int $por_pagina
     * @return mixed
     */
    public function practicantes_por_empresa($empresa_id, $pagina = 1, $por_pagina = 10)
	{
		return $this->jobRepo->get_active_jobs_by_author($empresa_id, $pagina, $por_pagina, self::TIPO_PRACTICANTE);
	}

    /**
     * @param $carrera_id
     * @param int $pagina
     * @param int $por_pagina
     * @return mixed
     */
    public function practicantes_por_carrera($carrera_id, $pagina = 1, $por_pagina = 10)
	{
		return $this->jobRepo->get_active_jobs_by_subkind($carrera_id, $pagina, $por_pagina, self::TIPO_PRACTICANTE);
	}

    /**
     * @param $keyword
     * @param $carrera_id
     * @param int $pagina
     * @param int $por_pagina
     * @return mixed
     */
    public function practicantes_por_keyword($keyword, $carrera_id, $pagina = 1, $por_pagina = 10)
	{
		return $this->jobRepo->get_active_jobs_by_keyword($keyword, $carrera_id, $pagina, $por_pagina, self::TIPO_PRACTICANTE);
	}
}
