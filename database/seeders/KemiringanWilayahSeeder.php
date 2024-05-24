<?php

namespace Database\Seeders;

use App\Models\Kemiringan_Wilayah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KemiringanWilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kemiringan_Wilayah::create([
            'id' => 1,
            'name' => 'Datar (0-8%)'
        ]);
        Kemiringan_Wilayah::create([
            'id' => 2,
            'name' => 'Landai (8-5%)'
        ]);
        Kemiringan_Wilayah::create([
            'id' => 3,
            'name' => 'Agak Curam (15-25%)'
        ]);
        Kemiringan_Wilayah::create([
            'id' => 4,
            'name' => 'Curam (25-45%)'
        ]);
        Kemiringan_Wilayah::create([
            'id' => 5,
            'name' => 'Sangat Curam (>45%)'
        ]);
    }
}
