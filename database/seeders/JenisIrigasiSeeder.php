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
            'name' => 'Organosol (Histosols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 4,
            'name' => 'Litosol (Entisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 5,
            'name' => 'Aluvial (Entisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 6,
            'name' => 'Regosol (Entisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 7,
            'name' => 'Umbrisol (Inceptisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 8,
            'name' => 'Renzina (Mollisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 9,
            'name' => 'Grumusol (Vertisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 10,
            'name' => 'Arenosol (Entisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 11,
            'name' => 'Andosol (Andisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 12,
            'name' => 'Latosol (Inceptisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 13,
            'name' => 'Molisol (Mollisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 14,
            'name' => 'Kambisol (Inceptisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 15,
            'name' => 'Gleisol (Inceptisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 16,
            'name' => 'Nitosol (Ultisols, Alfisols, Mollisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 17,
            'name' => 'Podsolik (Ultisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 19,
            'name' => 'Mediteran (Alfisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 20,
            'name' => 'Planosol (Albaqualfs, Albaquults)'
        ]);
        Jenis_Irigasi::create([
            'id' => 21,
            'name' => 'Podsol (Spodosols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 22,
            'name' => 'Oksisol (Oxisols)'
        ]);
        Jenis_Irigasi::create([
            'id' => 23,
            'name' => 'Lateritik (Oxisols, Ultisols, Alfisols)'
        ]);
    }
}
