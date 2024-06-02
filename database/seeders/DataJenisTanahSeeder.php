<?php

namespace Database\Seeders;

use App\Models\Jenis_Tanah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataJenisTanahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id_jenis_irigasi = Jenis_Tanah::get();

        $datas = [
            ['id_kota' => 3501, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 100],
            ['id_kota' => 3502, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 200], 
            ['id_kota' => 3503, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 300],
            ['id_kota' => 3504, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 400],
            ['id_kota' => 3505, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 500],
            ['id_kota' => 3506, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 600],
            ['id_kota' => 3507, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 700],
            ['id_kota' => 3508, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 800],
            ['id_kota' => 3509, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 900],
            ['id_kota' => 3510, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 1000],
            ['id_kota' => 3511, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 1100],
            ['id_kota' => 3512, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 1200],
            ['id_kota' => 3513, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 1300],
            ['id_kota' => 3514, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 1400],
            ['id_kota' => 3515, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 1500],
            ['id_kota' => 3516, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 1600],
            ['id_kota' => 3517, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 1700],
            ['id_kota' => 3518, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 1800],
            ['id_kota' => 3519, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 1900],
            ['id_kota' => 3520, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 2000],
            ['id_kota' => 3521, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 2100],
            ['id_kota' => 3522, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 2200],
            ['id_kota' => 3523, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 2300],
            ['id_kota' => 3524, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 2400],
            ['id_kota' => 3525, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 2500],
            ['id_kota' => 3526, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 2600],
            ['id_kota' => 3527, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 2700],
            ['id_kota' => 3528, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 2800],
            ['id_kota' => 3571, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 800],
            ['id_kota' => 3572, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 700],
            ['id_kota' => 3573, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 600],
            ['id_kota' => 3574, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 500],
            ['id_kota' => 3575, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 400],
            ['id_kota' => 3576, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 300],
            ['id_kota' => 3577, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 200],
            ['id_kota' => 3578, 'id_jenis_tanah' => trim($id_jenis_irigasi->random()->id), 'luas' => 100],
        ];

        foreach ($datas as $data) {
            \App\Models\JenisTanah::create($data);
        }
    }
}
