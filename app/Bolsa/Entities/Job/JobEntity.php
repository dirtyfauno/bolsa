<?php namespace Bolsa\Entities\Job;

use Bolsa\Entities\Job\Contracts\JobEntityInterface;
use Bolsa\Entities\Job\Contracts\JobRepositoryInterface;
use Bolsa\Entities\Job\Exceptions\MustBeGreaterThanZero;
use Bolsa\Entities\Job\Exceptions\MustBeIntegerValue;

/**
 * Class JobEntity
 * @package Bolsa\Entities\Job
 */
class JobEntity implements JobEntityInterface {

    /**
     * @var string
     */
    protected $job_kind_column;
    /**
     * @var string
     */
    protected $job_tag_column;
    /**
     * @var string
     */
    protected $job_string_id_column;
    /**
     * @var string
     */
    protected $job_created_at_column;
    /**
     * @var string
     */
    protected $job_author_column;

    /**
     * @var array
     */
    protected $array_keys_verifiers = array(
        "typejob_id",
        "author",
        "tagjob_id",
        "string_id",
        "created_at"
    );

    /**
     * @var Contracts\JobRepositoryInterface
     */
    protected $jobRepo;

    /**
     * @param array                  $job_model_columns
     * @param JobRepositoryInterface $repo
     */
    function __construct(array $job_model_columns, JobRepositoryInterface $repo)
    {
        $this->set_job_columns($job_model_columns);
        $this->jobRepo = $repo;
    }

    /**
     * @param array $input
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function post_job(array $input)
    {
        return $this->jobRepo->post_new_job($input);
    }

    /**
     * @param array $input
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update_job(array $input)
    {
        return $this->jobRepo->update_job($input);
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete_job($id)
    {
        return $this->jobRepo->delete_job($id);
    }

    /**
     * @param       $ofuscated_id
     * @param array $job_relationships
     *
     * @return Model|null|static
     */
    public function get_single_job($ofuscated_id, array $job_relationships = array())
    {
        return $this->jobRepo->get_single_job($ofuscated_id, $job_relationships);
    }

    /**
     * @param int $page
     * @param int $per_page
     * @param null $type
     * @param array $job_relationships
     * @param array $orderBy
     *
     * @return \stdClass
     */
    public function get_jobs($page = 1, $per_page = 10, $type = null, array $job_relationships = array(), array $orderBy = array())
    {
        $this->verify_common_params($page, $per_page);

        return $this->get_jobs_ready_for_pagination($page, $per_page, $type, $job_relationships);
    }

    /**
     * @param $author_id
     * @param int $requested_page
     * @param int $jobs_per_page
     * @param array $job_relationships
     * @param array $order_by
     * @internal param array $orderBy
     *
     * @return \stdClass
     */
    public function get_jobs_by_author_column($author_id, $requested_page = 1, $jobs_per_page = 10, array $job_relationships = array(), array $order_by = array())
    {
        $this->verify_common_params($requested_page, $jobs_per_page);

        return $this->jobRepo->get_active_jobs_by_author($author_id, $requested_page, $jobs_per_page, $order_by, $job_relationships);
    }

    /**
     * @param       $kind_value
     * @param int   $requested_page
     * @param int   $jobs_per_page
     * @param array $job_relationships
     * @param array $order_by
     *
     * @return \stdClass
     */
    public function get_jobs_by_kind_column($kind_value, $requested_page = 1, $jobs_per_page = 10, array $order_by = array(), array $job_relationships = array())
    {
        $this->verify_common_params($requested_page, $jobs_per_page);

        return $this->jobRepo->get_jobs_by_kind($kind_value, $requested_page, $jobs_per_page, $order_by, $job_relationships);
    }

    /**
     * @param $column_name
     * @param $value
     * @param $requested_page
     * @param $items_per_page
     * @param array $job_relationships
     * @return mixed
     */
    public function get_jobs_by_custom_column($column_name, $value, $requested_page, $items_per_page, array $job_relationships = array())
    {
        return $this->jobRepo->get_rows_by_custom_column_value($column_name, $value, $requested_page, $items_per_page, $job_relationships);
    }

    /**
     * @param array $columns
     * @param $requested_page
     * @param $jobs_per_page
     * @param array $order_by
     * @param array $job_relationships
     * @return mixed
     */
    public function get_jobs_by_2_custom_columns(array $columns, $requested_page, $jobs_per_page, array $order_by = array(), array $job_relationships = array())
    {
        return $this->jobRepo->get_jobs_by_2_columns($columns, $requested_page, $jobs_per_page, $order_by, $job_relationships);
    }

    /**
     * @param $page
     * @param $jobs_limit
     *
     * @throws Exceptions\MustBeIntegerValue
     */
    private function guardAgainstNotIntegerParameters($page, $jobs_limit)
    {
        if (! is_integer($page) || ! is_integer($jobs_limit))
        {
            throw new MustBeIntegerValue;
        }
    }

    /**
     * @param $page
     * @param $jobs_limit
     *
     * @throws Exceptions\MustBeGreaterThanZero
     */
    private function guardAgainstNotValidPageParameters($page, $jobs_limit)
    {

        if ($page <= 0 || $jobs_limit <= 0)
        {
            throw new MustBeGreaterThanZero;
        }
    }

    /**
     * @param array $columns
     *
     * @throws \Exception
     */
    private function set_job_columns(array $columns)
    {
        if (! is_array($columns))
        {
            throw new \Exception("must be array");
        }

        foreach ($this->array_keys_verifiers as $name)
        {
            if (! array_key_exists($name, $columns))
            {
                dd("{$name} not in the columns");
            }
        }

        $this->job_author_column = $columns['author'];
        $this->job_created_at_column = $columns['created_at'];
        $this->job_string_id_column = $columns['string_id'];
        $this->job_tag_column = $columns['tagjob_id'];
        $this->job_kind_column = $columns['typejob_id'];
    }

    /**
     * @param $page
     * @param $jobs_per_page
     * @param $job_type
     * @param array $job_relationships
     *
     * @return \stdClass
     */
    private function get_jobs_ready_for_pagination($page, $jobs_per_page, $job_type, array $job_relationships)
    {
        return $this->jobRepo->get_active_jobs($page, $jobs_per_page, $job_type, $job_relationships);
    }

    /**
     * @param $page
     * @param $jobs_limit
     */
    private function verify_common_params($page, $jobs_limit)
    {
        $this->guardAgainstNotIntegerParameters($page, $jobs_limit);

        $this->guardAgainstNotValidPageParameters($page, $jobs_limit);
    }
}
