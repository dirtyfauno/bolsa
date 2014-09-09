<?php

namespace spec\Bolsa\Entities\Job;

use Bolsa\Entities\Job\Contracts\JobRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use stdClass;

class JobEntitySpec extends ObjectBehavior {

	/**
	 * \Bolsa\Entities\Job\JobEntity
	 */
	protected $this;
	protected $columns = array(
		"typejob_id" => "carrera_id",
		"author"     => "empresa_id",
		"tagjob_id"  => "tag_id",
		"string_id"  => "string_id",
		"created_at" => "created_at");

	const Author = "google";

	const Type = "sistemas";

	const Tag = "programacion";

	const Page = 1;

	const ItemsPerPage = 10;

	function let(JobRepositoryInterface $jobRepo)
	{
		$this->beConstructedWith($this->columns, $jobRepo);
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('Bolsa\Entities\Job\JobEntity');
		$this->shouldImplement('Bolsa\Entities\Job\Contracts\JobEntityInterface');
	}

//	function it_should_return_object_when_getting_jobs(JobRepositoryInterface $jobRepo, stdClass $stdClass)
//	{
//		$this->expectsGeneralJobsReturned($jobRepo, $stdClass);
//		$this->get_jobs(self::Page, self::ItemsPerPage)
//		     ->shouldBeAnInstanceOf('stdClass');
//
//		$this->expectsSpecificJobsReturned($this->columns['author'], self::Author, $jobRepo, $stdClass);
//		$this->get_jobs_by_author(self::Author)
//		     ->shouldBeAnInstanceOf('stdClass');
//
//		$this->expectsSpecificJobsReturned($this->columns['typejob_id'], self::Type, $jobRepo, $stdClass);
//		$this->get_jobs_by_kind(self::Type)
//		     ->shouldBeAnInstanceOf('stdClass');
//
//		$this->expectsSpecificJobsReturned($this->columns['tagjob_id'], self::Tag, $jobRepo, $stdClass);
//		$this->get_jobs_by_tag(self::Tag)->shouldBeAnInstanceOf('stdClass');
//	}
//
//	//    function it_should_
//
//	function it_should_not_allow_passing_zero_items_per_page()
//	{
//		$parameters = array(self::Page, 0);
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeGreaterThanZero')
//		     ->during('get_jobs', $parameters);
//
//		$parameters = array(self::Author, self::Page, 0);
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeGreaterThanZero')
//		     ->during('get_jobs_by_author', $parameters);
//
//		$parameters = array(self::Type, self::Page, 0);
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeGreaterThanZero')
//		     ->during('get_jobs_by_kind', $parameters);
//
//
//		$parameters = array(self::Tag, self::Page, 0);
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeGreaterThanZero')
//		     ->during('get_jobs_by_tag', $parameters);
//	}
//
//	function it_should_not_allow_passing_a_negative_or_zero_page_number()
//	{
//		$parameters = array(- 1, self::ItemsPerPage);
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeGreaterThanZero')
//		     ->during('get_jobs', $parameters);
//
//		$parameters = array(self::Author, 0, self::ItemsPerPage);
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeGreaterThanZero')
//		     ->during('get_jobs_by_author', $parameters);
//
//		$parameters = array(self::Type, - 2, self::ItemsPerPage);
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeGreaterThanZero')
//		     ->during('get_jobs_by_kind', $parameters);
//
//
//		$parameters = array(self::Tag, 0, self::ItemsPerPage);
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeGreaterThanZero')
//		     ->during('get_jobs_by_tag', $parameters);
//	}
//
//	function it_should_just_allow_integer_parameters()
//	{
//		$parameters = array("1", "10");
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeIntegerValue')
//		     ->during('get_jobs', $parameters);
//
//		$parameters = array(self::Author, (array) 0, "10");
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeIntegerValue')
//		     ->during('get_jobs_by_author', $parameters);
//
//		$parameters = array(self::Type, "1", 4);
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeIntegerValue')
//		     ->during('get_jobs_by_kind', $parameters);
//
//		$parameters = array(self::Tag, (bool) "1", "10");
//		$this->shouldThrow('Bolsa\Entities\Job\Exceptions\MustBeIntegerValue')
//		     ->during('get_jobs_by_tag', $parameters);
//	}
//
//	private function expectsGeneralJobsReturned(JobRepositoryInterface $jobRepo, stdClass $stdClass)
//	{
//		$jobRepo->get_jobs(self::Page, self::ItemsPerPage, array())
//		     ->willReturn($stdClass);
//	}
//
//	private function expectsSpecificJobsReturned($column, $row, JobRepositoryInterface $jobRepo, stdClass $stdClass)
//	{
//		$jobRepo->get_rows_by_custom_column_value($column, $row, self::Page, self::ItemsPerPage, array())
//		     ->willReturn($stdClass);
//	}
}
