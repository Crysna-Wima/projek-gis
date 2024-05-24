<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jenis_Irigasi;

class JenisIrigasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jenis_Irigasi::create([
            'id' => 1,
            'name' => 'Wilayah Sungai'
        ]);
        Jenis_Irigasi::create([
            'id' => 2,
            'name' => 'Daerah Aliran Sungai'
        ]);
        Jenis_Irigasi::create([
            'id' => 3,
            'name' => 'Sungai'
        ]);
        Jenis_Irigasi::create([
            'id' => 4,
            'name' => 'Danau'
        ]);
        Jenis_Irigasi::create([
            'id' => 5,
            'name' => 'Embung'
        ]);
        Jenis_Irigasi::create([
            'id' => 6,
            'name' => 'Bendungan'
        ]);
        Jenis_Irigasi::create([
            'id' => 7,
            'name' => 'Bendung'
        ]);
        Jenis_Irigasi::create([
            'id' => 8,
            'name' => 'Waduk'
        ]);
        Jenis_Irigasi::create([
            'id' => 9,
            'name' => 'Tampungan Air Lainnya'
        ]);
        Jenis_Irigasi::create([
            'id' => 10,
            'name' => 'Pantai'
        ]);
        Jenis_Irigasi::create([
            'id' => 11,
            'name' => 'Tadah Hujan'
        ]);
    }
}
