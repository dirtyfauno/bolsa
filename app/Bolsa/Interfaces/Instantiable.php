<?php namespace Bolsa\Entities\Contracts;

/**
 * Interface Instantiable
 * @package Bolsa\Entities\Contracts
 */
interface Instantiable {

    /**
     * @param array $with
     *
     * @return mixed
     */
    public function make(array $with = array());
}