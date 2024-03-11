<?php

namespace App\Services\RoleHasMenu;

use LaravelEasyRepository\Service;
use App\Repositories\RoleHasMenu\RoleHasMenuRepository;

class RoleHasMenuServiceImplement extends Service implements RoleHasMenuService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(RoleHasMenuRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
