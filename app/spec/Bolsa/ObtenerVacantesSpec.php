<?php

namespace spec\Bolsa;

use Bolsa\Repositorios\JobRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use stdClass;
use VacanteModel;

class ObtenerVacantesSpec extends ObjectBehavior {

    const JOBS_PER_PAGE = 10;

    const PAGE = 1;

    const JOBS_TRAINEE_TYPE = 2;

    const JOBS_FORMAL_TYPE = 1;

    function let(JobRepository $jobRepository)
    {
        $this->beConstructedWith($jobRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Bolsa\ObtenerVacantes');
    }

    function it_should_get_the_jobs(JobRepository $jobRepository)
    {
        $page = self::PAGE;
        $perPage = self::JOBS_PER_PAGE;
        $formalType = self::JOBS_FORMAL_TYPE;
        $traineeType = self::JOBS_TRAINEE_TYPE;

        $jobRepository->get_active_jobs($page, $perPage, $formalType)->willReturn(new stdClass());
        $this->formales($page, $perPage)->shouldBeAnInstanceOf('stdClass');

        $jobRepository->get_active_jobs_by_author(1, $page, $perPage, $formalType)->willReturn(new stdClass());
        $this->formales_por_empresa(1, $page, $perPage)->shouldBeAnInstanceOf('stdClass');

        $jobRepository->get_active_jobs_by_subkind(1, $page, $perPage, $formalType)->willReturn(new stdClass());
        $this->formales_por_carrera(1, $page, $perPage)->shouldBeAnInstanceOf('stdClass');

        $jobRepository->get_active_jobs($page, $perPage, $traineeType)->willReturn(new stdClass());
        $this->practicantes($page, $perPage)->shouldBeAnInstanceOf('stdClass');

        $jobRepository->get_active_jobs_by_author(1, $page, $perPage, $traineeType)->willReturn(new stdClass());
        $this->practicantes_por_empresa(1, $page, $perPage)->shouldBeAnInstanceOf('stdClass');

        $jobRepository->get_active_jobs_by_subkind(1, $page, $perPage, $traineeType)->willReturn(new stdClass());
        $this->practicantes_por_carrera(1, $page, $perPage)->shouldBeAnInstanceOf('stdClass');
    }
}
