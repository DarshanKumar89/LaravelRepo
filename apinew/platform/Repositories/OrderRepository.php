<?php

namespace Platform\Repositories;

use Order;


class OrderRepository extends EloquentRepository {
    protected $model;
    /**
     * @param Order $model
     */
    function __construct(Order $model)
    {
        $this->model = $model;
    }


}
