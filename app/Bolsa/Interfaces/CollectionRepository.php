<?php

namespace Bolsa\Repositorios\Vacantes;

/**
 * Interface CollectionRepository
 * @package Bolsa\Repositorios\Vacantes
 */
interface CollectionRepository {

    /**
     * @return mixed
     */
    public function getAll();

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