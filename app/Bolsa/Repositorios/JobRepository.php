<?php namespace Bolsa\Repositorios;

use Bolsa\Entities\Job\Contracts\JobRepositoryInterface;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use stdClass;

/**
 * Class JobRepository
 * @package Bolsa\Repositorios
 */
class JobRepository implements JobRepositoryInterface {

    /**
     *
     */
    const ID_COLUMN = "string_id";

    /**
     *
     */
    const AUTHOR_COLUMN = "empresa_id";

    /**
     *
     */
    const KIND_COLUMN = "tipo_id";

    /**
     *
     */
    const SUBKIND_COLUMN = "carrera_id";

    /**
     * @var Eloquent
     */
    protected $vacanteModel;

    /**
     * @param Eloquent $vacanteModel
     */
    public function __construct(Eloquent $vacanteModel)
    {
        $this->vacanteModel = $vacanteModel;
    }

    /**
     * @param array $job_relationships
     *
     * @return Eloquent
     */
    public function make(array $job_relationships = array())
    {
        return $this->vacanteModel->with($job_relationships)->where("status", \VacanteModel::ACTIVA);
    }

    /**
     * @param array $job_relationships
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function getClosed(array $job_relationships = array())
    {
        return $this->vacanteModel->with($job_relationships)->where("status", \VacanteModel::CERRADA);
    }

    /**
     * @param       $kind_job_value
     * @param array $job_relationships
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function make_by_kind($kind_job_value, array $job_relationships = array())
    {
        return $this->make($job_relationships)->where(self::KIND_COLUMN, $kind_job_value);
    }

    /**
     * @param int   $id
     * @param array $model_relationships
     *
     * @return \Illuminate\Database\Eloquent\Collection|Model|static
     */
    public function get_job_by_id($id, array $model_relationships = array())
    {
        return $this->make($model_relationships)->find($id);
    }

    /**
     * @param array $input
     *
     * @return Model|static
     */
    public function post_new_job(array $input)
    {
        return $this->vacanteModel->create($input);
    }

    /**
     * @param array $input
     *
     * @return string
     */
    public function update_job(array $input)
    {
        return "actualizar";
    }

    /**
     * @param int $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete_job($id)
    {
        $row = $this->vacanteModel->find($id);

        if ($row->isEmpty())
        {
            throw new \Exception("no row id: {$id} from model: " . get_class($this->vacanteModel) . ", found");
        }

        return $row->delete();
    }

    /**
     * @param array $columns
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return stdClass
     */
    public function get_jobs_by_2_columns(array $columns, $page = 1, $per_page = 10, $type = null, array $relationships = array())
    {
        $object = $this->fill_object_for_multiple_columns($columns, $page, $per_page, $type, $relationships);

        return $object;
    }

    /**
     * @param       $column_to_find
     * @param       $value
     * @param int   $requested_page
     * @param int   $items_per_page
     * @param array $model_relationships
     *
     * @return stdClass
     */
    private function get_object_of_jobs_by_custom_column_value($column_to_find, $value, $page = 1, $per_page = 10, $type, array $relationships = array())
    {
        list($query, $total_jobs) = $this->query_by_column($type, $column_to_find, $value, $relationships);

        $object = $this->create_object_of_jobs($page, $per_page, $query, $total_jobs);

        return $object;
    }

    /**
     * @param       $column
     * @param       $value
     * @param array $relationships
     *
     * @return array
     */
    private function get_first_row_by_custom_column_value($column, $value, array $relationships = array())
    {
        try
        {
            $row = $this->make($relationships)->where($column, '=', $value)->firstOrFail();

            return array($row, false);
        }
        catch (ModelNotFoundException $e)
        {
            return array(null, true);
        }
    }

    /**
     * @param $page
     * @param $jobs_per_page
     *
     * @return stdClass
     */
    private function make_object($page, $jobs_per_page)
    {
        $obj = new stdClass();

        $obj->page = $page;

        $obj->jobsPerPage = $jobs_per_page;

        $obj->totalJobs = 0;

        $obj->jobs = array();

        return $obj;
    }

    /**
     * @param       $ofuscated_id
     * @param array $relationships
     *
     * @return array
     */
    public function get_single_job($ofuscated_id, array $relationships = array())
    {
        return $this->get_first_row_by_custom_column_value(self::ID_COLUMN, $ofuscated_id, $relationships);
    }

    /**
     * @param       $ofuscated_id
     * @param array $relationships
     *
     * @return array
     */
    public function get_closed_job($ofuscated_id, array $relationships = array())
    {
        try
        {
            $job = $this->vacanteModel->onlyTrashed()->where(self::ID_COLUMN, $ofuscated_id)->firstOrFail();

            return array($job, false);
        }
        catch (ModelNotFoundException $e)
        {
            return array(null, true);
        }
    }

    /**
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     * @param array $orderBy
     *
     * @return stdClass
     */
    public function get_active_jobs($page = 1, $per_page = 10, $type = null, array $relationships = array(), array $orderBy = array())
    {
        return $this->get_object_of_jobs($page, $per_page, $type, $relationships);
    }

    /**
     * @param       $author_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return stdClass
     */
    public function get_active_jobs_by_author($author_id, $page = 1, $per_page = 10, $type = null, array $relationships = array())
    {
        return $this->get_object_of_jobs_by_custom_column_value(self::AUTHOR_COLUMN, $author_id, $page, $per_page, $type, $relationships);
    }

    /**
     * @param       $kind_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return stdClass
     */
    public function get_jobs_by_kind($kind_id, $page = 1, $per_page = 10, $type = null, array $relationships = array())
    {
        return $this->get_object_of_jobs_by_custom_column_value(self::KIND_COLUMN, $kind_id, $page, $per_page, $type, $relationships);
    }

    /**
     * @param       $subkind_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return stdClass
     */
    public function get_active_jobs_by_subkind($subkind_id, $page = 1, $per_page = 10, $type = null, array $relationships = array())
    {
        return $this->get_object_of_jobs_by_custom_column_value(self::SUBKIND_COLUMN, $subkind_id, $page, $per_page, $type, $relationships);
    }

    /**
     * @param       $keyword_value
     * @param       $carrera_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return stdClass
     */
    public function get_active_jobs_by_keyword($keyword_value, $carrera_id, $page = 1, $per_page = 10, $type = null, array $relationships = array())
    {
        return $this->get_object_of_jobs_by_keyword($keyword_value, $carrera_id, $page, $per_page, $type, $relationships);
    }

    /**
     * @param $requested_page
     * @param $jobs_per_page
     * @param $query
     *
     * @return mixed
     */
    private function jobs_slice($requested_page, $jobs_per_page, $query)
    {
        return $query->skip($jobs_per_page * ($requested_page - 1))->take($jobs_per_page)->orderBy("updated_at", "desc")->get();
    }

    /**
     * @param array $columns
     * @param null  $kind_id
     *
     * @return int
     */
    public function count_jobs(array $columns, $kind_id = null)
    {
        if (is_null($kind_id))
        {
            $query = $this->make();
        }

        $query = $this->make_by_kind($kind_id);

        foreach ($columns as $column => $column_value)
        {
            $query = $query->where($column, '=', $column_value);
        }

        return (int) $query->count('id');
    }

    /**
     * @param      $keyword
     * @param      $carrera_id
     * @param null $kind_id
     *
     * @return int
     */
    public function count_jobs_by_keyword($keyword, $carrera_id, $kind_id = null)
    {
        if (is_null($kind_id))
        {
            $query = $this->make()->whereNested(function ($query) use ($keyword)
            {
                $query->where('keyword1', $keyword);

                $query->orWhere('keyword2', $keyword);
            })->where("carrera_id", $carrera_id);

            return (int) $query->count('id');
        }

        $query = $this->make_by_kind($kind_id)->whereNested(function ($query) use ($keyword)
        {
            $query->where('keyword1', $keyword);

            $query->orWhere('keyword2', $keyword);
        })->where("carrera_id", $carrera_id);

        return (int) $query->count('id');
    }

    /**
     * @param       $type
     * @param array $relationships
     *
     * @return array
     */
    public function query($type, array $relationships)
    {
        if (is_null($type))
        {
            $query = $this->make($relationships);

            $count = $this->make($relationships)->count('id');

            return array($query, $count);
        }
        else
        {
            $query = $this->make_by_kind($type, $relationships);

            $count = $this->make_by_kind($type, $relationships)->count('id');

            return array($query, $count);
        }
    }

    /**
     * @param       $page
     * @param       $per_page
     * @param       $type
     * @param array $relationships
     *
     * @return stdClass
     */
    private function get_object_of_jobs($page = 1, $per_page = 10, $type = null, array $relationships = array())
    {
        list($query, $total_jobs) = $this->query($type, $relationships);

        $object = $this->create_object_of_jobs($page, $per_page, $query, $total_jobs);

        return $object;
    }

    /**
     * @param array $cols
     * @param       $page
     * @param       $per_page
     * @param       $type
     * @param array $relations
     *
     * @return stdClass
     */
    private function fill_object_for_multiple_columns(array $cols, $page = 1, $per_page = 10, $type = null, array $relations = array())
    {
        list($query, $total_jobs) = $this->query_multiple_columns($cols, $type, $relations);

        $object = $this->create_object_of_jobs($page, $per_page, $query, $total_jobs);

        return $object;
    }

    /**
     * @param array $columns
     * @param       $type
     * @param array $relationships
     *
     * @return array
     */
    private function query_multiple_columns(array $columns, $type, array $relationships)
    {
        if (is_null($type))
        {
            $query = $this->make($relationships);
        }
        else
        {
            $query = $this->make_by_kind($type, $relationships);
        }

        foreach ($columns as $column => $column_value)
        {
            $query = $query->where($column, '=', $column_value);
        }

        $count = $query->count('id');

        return array($query, $count);
    }

    /**
     * @param $page
     * @param $per_page
     * @param $query
     * @param $total_jobs
     *
     * @return stdClass
     */
    private function create_object_of_jobs($page, $per_page, $query, $total_jobs)
    {
        $object = $this->make_object($page, $per_page);

        $jobs = $this->jobs_slice($page, $per_page, $query);

        $object->totalJobs = $total_jobs;

        $object->jobs = $jobs->all();

        return $object;
    }

    /**
     * @param $type
     * @param $column_to_find
     * @param $value
     * @param $relationships
     *
     * @return array
     */
    private function query_by_column($type, $column_to_find, $value, $relationships)
    {
        if (is_null($type))
        {
            $query = $this->make($relationships)->where($column_to_find, '=', $value);

            $count = $this->make($relationships)->where($column_to_find, '=', $value)->count('id');

            return array($query, $count);
        }
        else
        {
            $query = $this->make_by_kind($type, $relationships)->where($column_to_find, '=', $value);

            $count = $this->make_by_kind($type, $relationships)->where($column_to_find, '=', $value)->count('id');

            return array($query, $count);
        }
    }

    /**
     * @param       $keyword
     * @param       $carrera_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $kind_id
     * @param array $relationships
     *
     * @return stdClass
     */
    private function get_object_of_jobs_by_keyword($keyword, $carrera_id, $page = 1, $per_page = 10, $kind_id = null, array $relationships = array())
    {
        list($query, $total_jobs) = $this->query_for_keyword($keyword, $carrera_id, $kind_id, $relationships);

        $object = $this->create_object_of_jobs($page, $per_page, $query, $total_jobs);

        return $object;
    }

    /**
     * @param       $keyword
     * @param       $carrera_id
     * @param       $kind_id
     * @param array $relationships
     *
     * @return Eloquent|\Illuminate\Database\Eloquent\Builder|static
     */
    private function query_for_keyword($keyword, $carrera_id, $kind_id, array $relationships)
    {
        if (is_null($kind_id))
        {
            $query = $this->make($relationships)->whereNested(function ($query) use ($keyword)
            {
                $query->where('keyword1', $keyword);

                $query->orWhere('keyword2', $keyword);
            })->where("carrera_id", $carrera_id);

            $count = $this->make($relationships)->whereNested(function ($query) use ($keyword)
            {
                $query->where('keyword1', $keyword);

                $query->orWhere('keyword2', $keyword);
            })->where("carrera_id", $carrera_id)->count('id');

            return array($query, $count);
        }

        // SELECT * FROM "vacantes"
        // WHERE ("keyword1" = 'veniam' or "keyword2" = 'veniam')
        // and "tipo_id" = '2' and "carrera_id" = '2' ORDER BY "updated_at" DESC LIMIT 5 offset 0
        $query = $this->make_by_kind($kind_id, $relationships)->whereNested(function ($query) use ($keyword)
        {
            $query->where('keyword1', $keyword);
            $query->orWhere('keyword2', $keyword);
        })->where("carrera_id", $carrera_id);

        $count = $this->make_by_kind($kind_id, $relationships)->whereNested(function ($query) use ($keyword)
        {
            $query->where('keyword1', $keyword);
            $query->orWhere('keyword2', $keyword);
        })->where("carrera_id", $carrera_id)->count('id');

        return array($query, $count);
    }

    /**
     * @param       $author_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return stdClass
     */
    public function get_closed_jobs_by_author($author_id, $page = 1, $per_page = 10, $type = null, array $relationships = array())
    {
        $query = $this->getClosed($relationships)->where(self::AUTHOR_COLUMN, '=', $author_id)->onlyTrashed();

        $total_jobs = $this->getClosed($relationships)->where(self::AUTHOR_COLUMN, '=', $author_id)->onlyTrashed()->count('id');

        return $this->create_object_of_jobs($page, $per_page, $query, $total_jobs);
    }
}