<?php

namespace App\Repositories\Role;

use LaravelEasyRepository\Repository;

interface RoleRepository extends Repository{

    public function getRoleByName($name);
    public function getRoleByGuardName($guard_name);
}
