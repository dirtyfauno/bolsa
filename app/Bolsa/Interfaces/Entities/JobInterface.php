<?php

namespace Bolsa\Contracts\Entities;

interface JobInterface {

    public function getJobsChunk($itemsPerPage = 10, $page = 1, array $orderBy = array());

    public function getJobsByAuthorChunk($author, $page = 1, $itemsPerPage = 10, array $orderBy = array());

    public function getJobsByTypeChunk($kind, $itemsPerPage = 10, $page = 1, array $orderBy = array());

    public function getJobsByTagChunk($tag, $itemsPerPage = 10, $page = 1, array $orderBy = array());

    public function getJobsByTypeTagChunk($kind, $tag, $itemsPerPage = 10, $page = 1, array $orderBy = array());
}