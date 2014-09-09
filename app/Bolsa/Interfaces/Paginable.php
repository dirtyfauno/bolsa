<?php namespace Bolsa\Entities\Contracts;

/**
 * Interface Paginable
 * @package Bolsa\Entities\Contracts
 */
interface Paginable {

    /**
     * @param int   $page
     * @param int   $limit
     * @param array $with
     *
     * @return mixed
     */
    public function getByPage($page = 1, $limit = 10, $with = array());

    /**
     * @param null  $key
     * @param null  $value
     * @param int   $page
     * @param int   $limit
     * @param array $with
     *
     * @return mixed
     */
    public function getManyPageBy($key = null, $value = null, $page = 1, $limit = 10, array $with = array());
}