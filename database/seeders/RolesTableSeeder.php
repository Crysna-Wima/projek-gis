<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name'=>'DEVELOPER', 'guard_name'=>'web', 'desc'=>'Developer']);
        Role::create(['name'=>'ADMIN', 'guard_name'=>'web', 'desc'=>'Admin']);
        Role::create(['name'=>'READER', 'guard_name'=>'web', 'desc'=>'Reader']);
        Role::create(['name'=>'ADMIN2', 'guard_name'=>'web', 'desc'=>'Admin 2']);

        $this->command->info("Role Seeder Success !");
    }
}
