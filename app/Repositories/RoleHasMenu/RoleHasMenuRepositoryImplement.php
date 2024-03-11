<?php

namespace App\Repositories\RoleHasMenu;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\RoleHasMenu;

class RoleHasMenuRepositoryImplement extends Eloquent implements RoleHasMenuRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(RoleHasMenu $model)
    {
        $this->model = $model;
    }

    // get by role id
    public function getByRoleId($role_id)
    {
        return $this->model->where('role_id', $role_id)->get();
    }
}
