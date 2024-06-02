<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $datas = [
            ['type'=> 'dashboard', 'icon' => 'fas fa-home', 'name' => 'Dashboard', 'url' => '/dashboard', 'permission' => 'dashboard', 'order_no' => 1],
            // ['type'=> 'dashboard', 'icon' => 'fa fa-server text-success mr-5', 'name' => 'Master Data', 'url' => '#', 'permission' => 'masterdata'],
            ['type'=> 'dashboard', 'icon' => 'fas fa-coins', 'name' => 'Master Data', 'url' => '#', 'permission' => 'home', 'order_no' => 2],
            ['type'=> 'dashboard', 'icon' => 'fas fa-cog', 'name' => 'Web Settings', 'url' => '#', 'permission' => 'websettings', 'order_no' => 3],
        ];
        
        // Menu::insert($datas);        
        foreach ($datas as $k_datas => $v_datas){
            $check = Menu::where($v_datas)->first();
            if(!$check)
            Menu::create($v_datas);

        }

        $childrens = [
            //websettings
            ['type'=> 'dashboard', 'icon' => "fas fa-layer-group", 'name' => 'Menu', 'parent_id' => 3, 'url' => '/menusetting', 'permission' => 'menusetting', 'order_no' => 1],
            ['type'=> 'dashboard', 'icon' => "fas fa-user-cog", 'name' => 'Role', 'parent_id' => 3, 'url' => '/rolesetting', 'permission' => 'rolesetting', 'order_no' => 2],
            ['type'=> 'dashboard', 'icon' => "fas fa-route", 'name' => 'Route Settings', 'parent_id' => 3, 'url' => '/routesetting', 'permission' => 'routesetting', 'order_no' => 3],
            ['type'=> 'dashboard', 'icon' => "fas fa-user-friends", 'name' => 'Users Management', 'parent_id' => 3, 'url' => '/usersetting', 'permission' => 'usersetting', 'order_no' => 4],
            ['type'=> 'dashboard', 'icon' => "fas fa-user-shield", 'name' => 'Permission', 'parent_id' => 3, 'url' => '/permissionsetting', 'permission' => 'permission', 'order_no' => 5],
            // ['type'=> 'dashboard', 'icon' => "fa fa-upload text-success", 'name' => 'Company', 'parent_id' => 2, 'url' => 'company', 'permission' => 'company'],
            //master data

            //report

        ];

        // Menu::insert($childrens);             
        foreach ($childrens as $k_data => $v_data){
            $check = Menu::where($v_data)->first();
            if(!$check)
            Menu::create($v_data);

        }

        $this->command->info("Success insert Menu Seeder");
    }
}
