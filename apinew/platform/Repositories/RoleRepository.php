<?php

namespace Platform\Repositories;

class RoleRepository extends EloquentRepository {
    protected $model;
    /**
     * @param Role $model
     */
    function __construct(Role $model)
    {
        $this->model = $model;
    }

    function getRoles()
    {
        //
    }
}
