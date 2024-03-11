<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas=[
        	['action'=>'C','name'=>'Create'],
        	['action'=>'R','name'=>'Read'],
        	['action'=>'U','name'=>'Update'],
        	['action'=>'D','name'=>'Delete'],
            ['action'=>'A','name'=>'Approve'],
        ];

        Action::insert($datas);
        $this->command->info('Seeder Actions');
    }
}
