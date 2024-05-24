<?php

namespace Database\Seeders;

use App\Models\Jenis_Tanah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisTanahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jenis_Tanah::create([
            'id' => 1,
            'name' => 'Organosol (Histosols)'
        ]);
        Jenis_Tanah::create([
            'id' => 2,
            'name' => 'Litosol (Entisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 3,
            'name' => 'Aluvial (Entisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 4,
            'name' => 'Regosol (Entisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 5,
            'name' => 'Umbrisol (Inceptisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 6,
            'name' => 'Renzina (Mollisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 7,
            'name' => 'Grumusol (Vertisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 8,
            'name' => 'Arenosol (Entisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 9,
            'name' => 'Andosol (Andisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 10,
            'name' => 'Latosol (Inceptisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 11,
            'name' => 'Molisol (Mollisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 12,
            'name' => 'Kambisol (Inceptisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 13,
            'name' => 'Gleisol (Inceptisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 14,
            'name' => 'Nitosol (Ultisols, Alfisols, Mollisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 15,
            'name' => 'Podsolik (Ultisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 16,
            'name' => 'Mediteran (Alfisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 17,
            'name' => 'Planosol (Albaqualfs, Albaquults)'
        ]);
        Jenis_Tanah::create([
            'id' => 18,
            'name' => 'Podsol (Spodosols)'
        ]);
        Jenis_Tanah::create([
            'id' => 19,
            'name' => 'Oksisol (Oxisols)'
        ]);
        Jenis_Tanah::create([
            'id' => 20,
            'name' => 'Lateritik (Oxisols, Ultisols, Alfisols)'
        ]);
    }
}
