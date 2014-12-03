<?php

namespace Platform\Repositories;

use Group;


class GroupRepository extends EloquentRepository {
    protected $model;
    /**
     * @param Group $model
     */
    function __construct(Group $model)
    {
        $this->model = $model;
    }


}
