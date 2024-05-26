<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use AzisHapidin\IndoRegion\RawDataGetter;
use Illuminate\Support\Facades\DB;

class IndoRegionRegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     * 
     * @return void
     */
    public function run()
    {
        // Path to your CSV file
        $csvFile = database_path('seeders/csv/kota.csv');

        // Read the CSV file
        $csvData = array_map('str_getcsv', file($csvFile));

        // Remove the header (if exists)
        $header = array_shift($csvData);

        // Prepare the data for insertion
        $regencies = [];
        foreach ($csvData as $row) {
            $regencies[] = [
                'id' => $row[0],
                'province_id' => $row[1],
                'name' => $row[2],
                'latitude' => $row[3],
                'longitude' => $row[4]
            ];
        }

        // Insert data into the database
        DB::table('regencies')->insert($regencies);
    }
}
