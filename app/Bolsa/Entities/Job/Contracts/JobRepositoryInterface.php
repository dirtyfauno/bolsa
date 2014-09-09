<?php namespace Bolsa\Entities\Job\Contracts;

/**
 * Interface JobRepositoryInterface
 * @package Bolsa\Entities\Job\Contracts
 */
interface JobRepositoryInterface {

    /**
     * @param       $ofuscated_id
     * @param array $relationships
     *
     * @return mixed
     */
    public function get_single_job($ofuscated_id, array $relationships = array());

    /**
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     * @param array $orderBy
     *
     * @return mixed
     */
    public function get_active_jobs($page = 1, $per_page = 10, $type = null, array $relationships = array(), array $orderBy = array());

    /**
     * @param       $author_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return mixed
     */
    public function get_active_jobs_by_author($author_id, $page = 1, $per_page = 10, $type = null, array $relationships = array());

    /**
     * @param       $kind_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return mixed
     */
    public function get_jobs_by_kind($kind_id, $page = 1, $per_page = 10, $type = null, array $relationships = array());

    /**
     * @param       $subkind_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return mixed
     */
    public function get_active_jobs_by_subkind($subkind_id, $page = 1, $per_page = 10, $type = null, array $relationships = array());

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function post_new_job(array $input);

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function update_job(array $input);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete_job($id);

    /**
     * @param       $keyword_value
     * @param       $carrera_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return mixed
     */
    public function get_active_jobs_by_keyword($keyword_value, $carrera_id, $page = 1, $per_page = 10, $type = null, array $relationships = array());

    /**
     * @param       $author_id
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     *
     * @return mixed
     */
    public function get_closed_jobs_by_author($author_id, $page = 1, $per_page = 10, $type = null, array $relationships = array());
}