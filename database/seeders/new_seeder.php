<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class new_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create menu
        $dataMenu = [
            ['type' => 'dashboard', 'icon' => 'fas fa-seedling', 'name' => 'Produktifitas Padi', 'url' => '/master-data/produktifitas', 'permission' => 'produktifitas', 'order_no' => 0, 'parent_id' => 2],
            ['type' => 'dashboard', 'icon' => 'fas fa-utensil-spoon', 'name' => 'Irigasi', 'url' => '/master-data/irigasi', 'permission' => 'irigasi', 'order_no' => 1, 'parent_id' => 2],
            ['type' => 'dashboard', 'icon' => 'fas fa-cloud-rain', 'name' => 'Curah Hujan', 'url' => '/master-data/curah-hujan', 'permission' => 'curahhujan', 'order_no' => 2, 'parent_id' => 2],
            ['type' => 'dashboard', 'icon' => 'fas fa-mountain', 'name' => 'Kemiringan', 'url' => '/master-data/kemiringan', 'permission' => 'kemiringan', 'order_no' => 3, 'parent_id' => 2],
            ['type' => 'dashboard', 'icon' => 'fas fa-icicles', 'name' => 'Jenis Tanah', 'url' => '/master-data/jenis-tanah', 'permission' => 'jenistanah', 'order_no' => 4, 'parent_id' => 2],
        ];

        foreach ($dataMenu as $menu) {
            $check = \App\Models\Menu::where('name', $menu['name'])->first();
            if (!$check) {
                \App\Models\Menu::create($menu);
            }
        }

        // create permission
        $idMenuProduktifitas = \App\Models\Menu::where('name', 'Produktifitas Padi')->first()->id;
        $idMenuIrigasi = \App\Models\Menu::where('name', 'Irigasi')->first()->id;
        $idMenuCurahHujan = \App\Models\Menu::where('name', 'Curah Hujan')->first()->id;
        $idMenuKemiringan = \App\Models\Menu::where('name', 'Kemiringan')->first()->id;
        $idMenuJenisTanah = \App\Models\Menu::where('name', 'Jenis Tanah')->first()->id;

        $dataPermission = [
            ['name' => 'produktifitas-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => $idMenuProduktifitas],
            ['name' => 'produktifitas-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => $idMenuProduktifitas],
            ['name' => 'produktifitas-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => $idMenuProduktifitas],
            ['name' => 'produktifitas-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => $idMenuProduktifitas],
            ['name' => 'produktifitas-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => $idMenuProduktifitas],

            ['name' => 'irigasi-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => $idMenuIrigasi],
            ['name' => 'irigasi-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => $idMenuIrigasi],
            ['name' => 'irigasi-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => $idMenuIrigasi],
            ['name' => 'irigasi-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => $idMenuIrigasi],
            ['name' => 'irigasi-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => $idMenuIrigasi],

            ['name' => 'curahhujan-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => $idMenuCurahHujan],
            ['name' => 'curahhujan-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => $idMenuCurahHujan],
            ['name' => 'curahhujan-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => $idMenuCurahHujan],
            ['name' => 'curahhujan-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => $idMenuCurahHujan],
            ['name' => 'curahhujan-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => $idMenuCurahHujan],

            ['name' => 'kemiringan-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => $idMenuKemiringan],
            ['name' => 'kemiringan-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => $idMenuKemiringan],
            ['name' => 'kemiringan-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => $idMenuKemiringan],
            ['name' => 'kemiringan-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => $idMenuKemiringan],
            ['name' => 'kemiringan-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => $idMenuKemiringan],

            ['name' => 'jenistanah-C', 'guard_name' => 'web', 'action_id' => 'C', 'menu_id' => $idMenuJenisTanah],
            ['name' => 'jenistanah-R', 'guard_name' => 'web', 'action_id' => 'R', 'menu_id' => $idMenuJenisTanah],
            ['name' => 'jenistanah-U', 'guard_name' => 'web', 'action_id' => 'U', 'menu_id' => $idMenuJenisTanah],
            ['name' => 'jenistanah-D', 'guard_name' => 'web', 'action_id' => 'D', 'menu_id' => $idMenuJenisTanah],
            ['name' => 'jenistanah-A', 'guard_name' => 'web', 'action_id' => 'A', 'menu_id' => $idMenuJenisTanah],
        ];

        foreach ($dataPermission as $permission) {
            $check = \App\Models\Permission::where($permission)->first();
            if (!$check) {
                \App\Models\Permission::create($permission);
            }
        }

        // assign permission to role admin
        $roleAdmin = \Spatie\Permission\Models\Role::where('name', 'ADMIN')->first();

        if ($roleAdmin) {
            $permissionsProduktifitas = \App\Models\Permission::where('menu_id', $idMenuProduktifitas)->get();
            $permissionsIrigasi = \App\Models\Permission::where('menu_id', $idMenuIrigasi)->get();
            $permissionsCurahHujan = \App\Models\Permission::where('menu_id', $idMenuCurahHujan)->get();
            $permissionsKemiringan = \App\Models\Permission::where('menu_id', $idMenuKemiringan)->get();
            $permissionsJenisTanah = \App\Models\Permission::where('menu_id', $idMenuJenisTanah)->get();

            // add permission to role
            foreach ($permissionsProduktifitas as $permission) {
                $roleAdmin->givePermissionTo($permission->name);
            }

            foreach ($permissionsIrigasi as $permission) {
                $roleAdmin->givePermissionTo($permission->name);
            }

            foreach ($permissionsCurahHujan as $permission) {
                $roleAdmin->givePermissionTo($permission->name);
            }

            foreach ($permissionsKemiringan as $permission) {
                $roleAdmin->givePermissionTo($permission->name);
            }

            foreach ($permissionsJenisTanah as $permission) {
                $roleAdmin->givePermissionTo($permission->name);
            }
        }

        // add menu to role
        \App\Models\RoleHasMenu::insert([
            ['role_id' => 2, 'menu_id' => $idMenuProduktifitas],
            ['role_id' => 2, 'menu_id' => $idMenuIrigasi],
            ['role_id' => 2, 'menu_id' => $idMenuCurahHujan],
            ['role_id' => 2, 'menu_id' => $idMenuKemiringan],
            ['role_id' => 2, 'menu_id' => $idMenuJenisTanah],
        ]);

        // add route
        $dataRoute = [
            // route produktifitas
            ['permission' => 'produktifitas-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/master-data/produktifitas', 'route' => 'MasterData\ProduktifitasController@index', 'guard' => 'web'],
            ['permission' => 'produktifitas-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/master-data/produktifitas/list', 'route' => 'MasterData\ProduktifitasController@datatables', 'guard' => 'web'],
            ['permission' => 'produktifitas-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/master-data/produktifitas/{id}', 'route' => 'MasterData\ProduktifitasController@show', 'guard' => 'web'],
            ['permission' => 'produktifitas-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/master-data/produktifitas/destroy/{id}', 'route' => 'MasterData\ProduktifitasController@destroy', 'guard' => 'web'],
            ['permission' => 'produktifitas-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/master-data/produktifitas', 'route' => 'MasterData\ProduktifitasController@store', 'guard' => 'web'],
            ['permission' => 'produktifitas-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/master-data/produktifitas/{id}', 'route' => 'MasterData\ProduktifitasController@update', 'guard' => 'web'],

            // route irigasi
            ['permission' => 'irigasi-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/master-data/irigasi', 'route' => 'MasterData\IrigasiController@index', 'guard' => 'web'],
            ['permission' => 'irigasi-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/master-data/irigasi/list', 'route' => 'MasterData\IrigasiController@datatables', 'guard' => 'web'],
            ['permission' => 'irigasi-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/master-data/irigasi/{id}', 'route' => 'MasterData\IrigasiController@show', 'guard' => 'web'],
            ['permission' => 'irigasi-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/master-data/irigasi/destroy/{id}', 'route' => 'MasterData\IrigasiController@destroy', 'guard' => 'web'],
            ['permission' => 'irigasi-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/master-data/irigasi', 'route' => 'MasterData\IrigasiController@store', 'guard' => 'web'],
            ['permission' => 'irigasi-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/master-data/irigasi/{id}', 'route' => 'MasterData\IrigasiController@update', 'guard' => 'web'],

            // route curah hujan
            ['permission' => 'curahhujan-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/master-data/curah-hujan', 'route' => 'MasterData\CurahHujanController@index', 'guard' => 'web'],
            ['permission' => 'curahhujan-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/master-data/curah-hujan/list', 'route' => 'MasterData\CurahHujanController@datatables', 'guard' => 'web'],
            ['permission' => 'curahhujan-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/master-data/curah-hujan/{id}', 'route' => 'MasterData\CurahHujanController@show', 'guard' => 'web'],
            ['permission' => 'curahhujan-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/master-data/curah-hujan/destroy/{id}', 'route' => 'MasterData\CurahHujanController@destroy', 'guard' => 'web'],
            ['permission' => 'curahhujan-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/master-data/curah-hujan', 'route' => 'MasterData\CurahHujanController@store', 'guard' => 'web'],
            ['permission' => 'curahhujan-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/master-data/curah-hujan/{id}', 'route' => 'MasterData\CurahHujanController@update', 'guard' => 'web'],

            // route kemiringan
            ['permission' => 'kemiringan-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/master-data/kemiringan', 'route' => 'MasterData\KemiringanController@index', 'guard' => 'web'],
            ['permission' => 'kemiringan-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/master-data/kemiringan/list', 'route' => 'MasterData\KemiringanController@datatables', 'guard' => 'web'],
            ['permission' => 'kemiringan-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/master-data/kemiringan/{id}', 'route' => 'MasterData\KemiringanController@show', 'guard' => 'web'],
            ['permission' => 'kemiringan-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/master-data/kemiringan/destroy/{id}', 'route' => 'MasterData\KemiringanController@destroy', 'guard' => 'web'],
            ['permission' => 'kemiringan-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/master-data/kemiringan', 'route' => 'MasterData\KemiringanController@store', 'guard' => 'web'],
            ['permission' => 'kemiringan-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/master-data/kemiringan/{id}', 'route' => 'MasterData\KemiringanController@update', 'guard' => 'web'],

            // route jenis tanah
            ['permission' => 'jenistanah-R', 'middleware' => 'lang,authz', 'type' => 'view', 'method' => 'GET', 'url' => '/master-data/jenis-tanah', 'route' => 'MasterData\JenisTanahController@index', 'guard' => 'web'],
            ['permission' => 'jenistanah-R', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/master-data/jenis-tanah/list', 'route' => 'MasterData\JenisTanahController@datatables', 'guard' => 'web'],
            ['permission' => 'jenistanah-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'GET', 'url' => '/master-data/jenis-tanah/{id}', 'route' => 'MasterData\JenisTanahController@show', 'guard' => 'web'],
            ['permission' => 'jenistanah-D', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'DELETE', 'url' => '/master-data/jenis-tanah/destroy/{id}', 'route' => 'MasterData\JenisTanahController@destroy', 'guard' => 'web'],
            ['permission' => 'jenistanah-C', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/master-data/jenis-tanah', 'route' => 'MasterData\JenisTanahController@store', 'guard' => 'web'],
            ['permission' => 'jenistanah-U', 'middleware' => 'lang,authz', 'type' => 'data', 'method' => 'POST', 'url' => '/master-data/jenis-tanah/{id}', 'route' => 'MasterData\JenisTanahController@update', 'guard' => 'web'],
        ];

        foreach ($dataRoute as $route) {
            $check = \App\Models\Routes::where($route)->first();
            if (!$check) {
                \App\Models\Routes::create($route);
            }
        }

        $this->command->info('Success insert Data Seeder');
    }
}
