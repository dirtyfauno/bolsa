<?php namespace Bolsa\Entities\Job\Contracts;

/**
 * Interface JobEntityInterface
 * @package Bolsa\Entities\Job\Contracts
 */
interface JobEntityInterface {

    /**
     * @param       $ofuscated_id
     * @param array $with
     *
     * @return mixed
     */
    public function get_single_job($ofuscated_id, array $with = array());

    /**
     * @param int   $page
     * @param int   $per_page
     * @param null  $type
     * @param array $relationships
     * @param array $orderBy
     *
     * @return mixed
     */
    public function get_jobs($page = 1, $per_page = 10, $type = null, array $relationships = array(), array $orderBy = array());

    /**
     * @param       $author_id
     * @param int   $requested_page
     * @param int   $itemsPerPage
     * @param array $with
     * @param array $orderBy
     *
     * @return mixed
     */
    public function get_jobs_by_author_column($author_id, $requested_page = 1, $itemsPerPage = 10, array $with = array(), array $orderBy = array());

    /**
     * @param       $kind
     * @param int   $itemsPerRequestedPage
     * @param int   $page
     * @param array $with
     * @param array $orderBy
     *
     * @return mixed
     */
    public function get_jobs_by_kind_column($kind, $itemsPerRequestedPage = 10, $page = 1, array $with = array(), array $orderBy = array());

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function post_job(array $input);

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
     * @param       $column_name
     * @param       $value
     * @param       $requested_page
     * @param       $items_per_page
     * @param array $job_relationships
     *
     * @return mixed
     */
    public function get_jobs_by_custom_column($column_name, $value, $requested_page, $items_per_page, array $job_relationships = array());
}