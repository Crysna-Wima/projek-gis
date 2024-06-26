<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);
        $this->call(RoleHasMenusTableSeeder::class);
        $this->call(RoutesTableSeeder::class);
        $this->call(GlobalVarsTableSeeder::class);
        $this->call(IndoRegionSeeder::class);
        $this->call(new_seeder::class);
        $this->call(JenisIrigasiSeeder::class);
        $this->call(JenisTanahSeeder::class);
        $this->call(KemiringanWilayahSeeder::class);
        $this->call(ProduktifitasSeeder::class);
        $this->call(DataIrigasi::class);
        $this->call(CurahHujanSeeder::class);
        $this->call(DataKemiringanSeeder::class);
        $this->call(DataJenisTanahSeeder::class);

    }
}
