<?php

namespace App\Services\Menu;

use LaravelEasyRepository\Service;
use App\Repositories\Menu\MenuRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\RoleHasMenu\RoleHasMenuRepository;

class MenuServiceImplement extends Service implements MenuService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $menuRepository;
     protected $roleRepository;
      protected $roleHasMenuRepository;

    public function __construct(MenuRepository $menuRepository, RoleRepository $roleRepository, RoleHasMenuRepository $roleHasMenuRepository)
    {
      $this->menuRepository = $menuRepository;
      $this->roleRepository = $roleRepository;
      $this->roleHasMenuRepository = $roleHasMenuRepository;
    }

    public function getDashboardMenu($user)
    {
      // get role by name and guard name
        $role = $this->roleRepository->getRoleByName($user->getRoleNames());
        $role = $role->first();
        // get role has menu by role id
    }
}
