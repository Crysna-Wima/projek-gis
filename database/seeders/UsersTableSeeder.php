<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            ['username' => 'admin', 'email' => 'admin@company.com', 'password' => Hash::make('admin'), 'status' => 'y', 'first_name' => 'Admin', 'last_name' => 'User'], // password = 'admin
            ['username' => 'admin2', 'email' => 'admin2@company.com', 'password' => Hash::make('admin2'), 'status' => 'y', 'first_name' => 'Admin2', 'last_name' => 'User2'], // password = 'admin2
            ['username' => 'developer', 'email' => 'developer@company.com', 'password' => Hash::make('developer'), 'status' => 'y', 'first_name' => 'Developer', 'last_name' => 'User'], // password = 'developer
            ['username' => 'view', 'email' => 'view@company.com', 'password' => Hash::make('view'), 'status' => 'y', 'first_name' => 'View', 'last_name' => 'User'], // password = 'view
        ];

        User::insert($users);
        $this->command->info('User Seeders SuccessFullt');
    }
}
