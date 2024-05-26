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
            'name' => 'Organosol (Histosols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Litosol (Entisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Aluvial (Entisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Regosol (Entisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Umbrisol (Inceptisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Renzina (Mollisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Grumusol (Vertisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Arenosol (Entisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Andosol (Andisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Latosol (Inceptisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Molisol (Mollisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Kambisol (Inceptisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Gleisol (Inceptisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Nitosol (Ultisols, Alfisols, Mollisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Podsolik (Ultisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Mediteran (Alfisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Planosol (Albaqualfs, Albaquults)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Podsol (Spodosols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Oksisol (Oxisols)'
        ]);
        Jenis_Tanah::create([
            'name' => 'Lateritik (Oxisols, Ultisols, Alfisols)'
        ]);
    }
}
