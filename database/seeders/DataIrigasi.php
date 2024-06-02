<?php

namespace Database\Seeders;

use App\Models\Jenis_Irigasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataIrigasi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id_jenis_irigasi = Jenis_Irigasi::get();

        $datas = [
            ['id_kota' => 3501, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 100],
            ['id_kota' => 3502, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 200], 
            ['id_kota' => 3503, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 300],
            ['id_kota' => 3504, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 400],
            ['id_kota' => 3505, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 500],
            ['id_kota' => 3506, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 600],
            ['id_kota' => 3507, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 700],
            ['id_kota' => 3508, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 800],
            ['id_kota' => 3509, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 900],
            ['id_kota' => 3510, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1000],
            ['id_kota' => 3511, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1100],
            ['id_kota' => 3512, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1200],
            ['id_kota' => 3513, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1300],
            ['id_kota' => 3514, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1400],
            ['id_kota' => 3515, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1500],
            ['id_kota' => 3516, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1600],
            ['id_kota' => 3517, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1700],
            ['id_kota' => 3518, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1800],
            ['id_kota' => 3519, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1900],
            ['id_kota' => 3520, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 2000],
            ['id_kota' => 3521, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 2100],
            ['id_kota' => 3522, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 2200],
            ['id_kota' => 3523, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 2300],
            ['id_kota' => 3524, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 2400],
            ['id_kota' => 3525, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 2500],
            ['id_kota' => 3526, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 2600],
            ['id_kota' => 3527, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 2700],
            ['id_kota' => 3528, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 2800],
            ['id_kota' => 3571, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 800],
            ['id_kota' => 3572, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 700],
            ['id_kota' => 3573, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 600],
            ['id_kota' => 3574, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 500],
            ['id_kota' => 3575, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 400],
            ['id_kota' => 3576, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 300],
            ['id_kota' => 3577, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 200],
            ['id_kota' => 3578, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 100],
            ['id_kota' => 3501, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1100],
            ['id_kota' => 3502, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1200], 
            ['id_kota' => 3503, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1300],
            ['id_kota' => 3504, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1400],
            ['id_kota' => 3505, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1500],
            ['id_kota' => 3506, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1600],
            ['id_kota' => 3507, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1700],
            ['id_kota' => 3508, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1800],
            ['id_kota' => 3509, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 1900],
            ['id_kota' => 3510, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 100],
            ['id_kota' => 3511, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 110],
            ['id_kota' => 3512, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 120],
            ['id_kota' => 3513, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 130],
            ['id_kota' => 3514, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 140],
            ['id_kota' => 3515, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 150],
            ['id_kota' => 3516, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 160],
            ['id_kota' => 3517, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 170],
            ['id_kota' => 3518, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 180],
            ['id_kota' => 3519, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 190],
            ['id_kota' => 3520, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 200],
            ['id_kota' => 3521, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 210],
            ['id_kota' => 3522, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 220],
            ['id_kota' => 3523, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 230],
            ['id_kota' => 3524, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 240],
            ['id_kota' => 3525, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 250],
            ['id_kota' => 3526, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 260],
            ['id_kota' => 3527, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 270],
            ['id_kota' => 3528, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 200],
            ['id_kota' => 3571, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 800],
            ['id_kota' => 3572, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 700],
            ['id_kota' => 3573, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 600],
            ['id_kota' => 3574, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 500],
            ['id_kota' => 3575, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 400],
            ['id_kota' => 3576, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 300],
            ['id_kota' => 3577, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 200],
            ['id_kota' => 3578, 'tahun' => 2024, 'id_jenis_irigasi' => trim($id_jenis_irigasi->random()->id), 'luas' => 100],
        ];

        foreach ($datas as $data) {
            \App\Models\Irigasi::create($data);
        }
    }
}
