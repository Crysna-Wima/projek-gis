<?php

namespace App\Repositories\Menu;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Menu;

class MenuRepositoryImplement extends Eloquent implements MenuRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    // get parent menu
    public function getParentMenu()
    {
        return $this->model->where('parent_id', 0)->get();
    }

    // get dashboard menu
    
}
