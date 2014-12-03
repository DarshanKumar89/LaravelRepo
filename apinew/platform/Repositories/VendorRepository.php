<?php

namespace Platform\Repositories;

use Vendor;


class VendorRepository extends EloquentRepository {
    protected $model;
    /**
     * @param Vendor $model
     */
    function __construct(Vendor $model)
    {
        $this->model = $model;
    }


}
