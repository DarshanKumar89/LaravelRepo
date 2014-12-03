<?php

namespace Platform\Repositories;

use Sample;


class SampleRepository extends EloquentRepository {
    protected $model;
    /**
     * @param Sample $model
     */
    function __construct(Sample $model)
    {
        $this->model = $model;
    }


}
