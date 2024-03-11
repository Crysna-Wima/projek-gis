<?php

namespace App\Repositories\Role;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Role;

class RoleRepositoryImplement extends Eloquent implements RoleRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    // get role by name in array
    public function getRoleByName($name)
    {
        return $this->model->where('name', $name)->get();
    }

    // get role by guard name in array
    public function getRoleByGuardName($guard_name)
    {
        return $this->model->where('guard_name', $guard_name)->get();
    }
    
}
