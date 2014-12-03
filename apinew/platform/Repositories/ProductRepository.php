<?php

namespace Platform\Repositories;

use Product;

class ProductRepository extends EloquentRepository {

    protected $model;
    /**
     * @param Template $model
     */
    function __construct(Product $model)
    {
        $this->model = $model;
    }
    public function getbyUID($uid)
    {
        return Product::where('uid','=',$uid);
    }


}
