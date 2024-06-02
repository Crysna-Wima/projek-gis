<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddLatitudeLongitudeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kotaData = [
            ['id' => '3501', 'province_id' => '35', 'name' => 'KABUPATEN PACITAN', 'latitude' => '-8.204614', 'longitude' => '111.08769'],
            ['id' => '3502', 'province_id' => '35', 'name' => 'KABUPATEN PONOROGO', 'latitude' => '-7.867827', 'longitude' => '111.466003'],
            ['id' => '3503', 'province_id' => '35', 'name' => 'KABUPATEN TRENGGALEK', 'latitude' => '-8.05', 'longitude' => '111.7166667'],
            ['id' => '3504', 'province_id' => '35', 'name' => 'KABUPATEN TULUNGAGUNG', 'latitude' => '-8.0666667', 'longitude' => '111.9'],
            ['id' => '3505', 'province_id' => '35', 'name' => 'KABUPATEN BLITAR', 'latitude' => '-8.1014419', 'longitude' => '112.162762'],
            ['id' => '3506', 'province_id' => '35', 'name' => 'KABUPATEN KEDIRI', 'latitude' => '-7.816895', 'longitude' => '112.011398'],
            ['id' => '3507', 'province_id' => '35', 'name' => 'KABUPATEN MALANG', 'latitude' => '-8.0495643', 'longitude' => '112.6884549'],
            ['id' => '3508', 'province_id' => '35', 'name' => 'KABUPATEN LUMAJANG', 'latitude' => '-8.137022', 'longitude' => '113.226601'],
            ['id' => '3509', 'province_id' => '35', 'name' => 'KABUPATEN JEMBER', 'latitude' => '-8.172357', 'longitude' => '113.700302'],
            ['id' => '3510', 'province_id' => '35', 'name' => 'KABUPATEN BANYUWANGI', 'latitude' => '-8.2186111', 'longitude' => '114.3669444'],
            ['id' => '3511', 'province_id' => '35', 'name' => 'KABUPATEN BONDOWOSO', 'latitude' => '-7.917704', 'longitude' => '113.813483'],
            ['id' => '3512', 'province_id' => '35', 'name' => 'KABUPATEN SITUBONDO', 'latitude' => '-7.702534', 'longitude' => '113.955605'],
            ['id' => '3513', 'province_id' => '35', 'name' => 'KABUPATEN PROBOLINGGO', 'latitude' => '-7.753965', 'longitude' => '113.210675'],
            ['id' => '3514', 'province_id' => '35', 'name' => 'KABUPATEN PASURUAN', 'latitude' => '-6.8623098', 'longitude' => '108.8001936'],
            ['id' => '3515', 'province_id' => '35', 'name' => 'KABUPATEN SIDOARJO', 'latitude' => '-7.4530278', 'longitude' => '112.7173389'],
            ['id' => '3516', 'province_id' => '35', 'name' => 'KABUPATEN MOJOKERTO', 'latitude' => '-7.488075', 'longitude' => '112.427027'],
            ['id' => '3517', 'province_id' => '35', 'name' => 'KABUPATEN JOMBANG', 'latitude' => '-7.5468395', 'longitude' => '112.2264794'],
            ['id' => '3518', 'province_id' => '35', 'name' => 'KABUPATEN NGANJUK', 'latitude' => '-7.602932', 'longitude' => '111.901808'],
            ['id' => '3519', 'province_id' => '35', 'name' => 'KABUPATEN MADIUN', 'latitude' => '-7.627753', 'longitude' => '111.505483'],
            ['id' => '3520', 'province_id' => '35', 'name' => 'KABUPATEN MAGETAN', 'latitude' => '-7.6493413', 'longitude' => '111.3381593'],
            ['id' => '3521', 'province_id' => '35', 'name' => 'KABUPATEN NGAWI', 'latitude' => '-7.38993', 'longitude' => '111.46193'],
            ['id' => '3522', 'province_id' => '35', 'name' => 'KABUPATEN BOJONEGORO', 'latitude' => '0.882681', 'longitude' => '124.4669566'],
            ['id' => '3523', 'province_id' => '35', 'name' => 'KABUPATEN TUBAN', 'latitude' => '-8.7493146', 'longitude' => '115.1711298'],
            ['id' => '3524', 'province_id' => '35', 'name' => 'KABUPATEN LAMONGAN', 'latitude' => '-7.1228244', 'longitude' => '112.3735889'],
            ['id' => '3525', 'province_id' => '35', 'name' => 'KABUPATEN GRESIK', 'latitude' => '-7.15665', 'longitude' => '112.6555'],
            ['id' => '3526', 'province_id' => '35', 'name' => 'KABUPATEN BANGKALAN', 'latitude' => '-7.0306912', 'longitude' => '112.7450068'],
            ['id' => '3527', 'province_id' => '35', 'name' => 'KABUPATEN SAMPANG', 'latitude' => '-7.19131290', 'longitude' => '113.25322670'],
            ['id' => '3528', 'province_id' => '35', 'name' => 'KABUPATEN PAMEKASAN', 'latitude' => '-7.1666667', 'longitude' => '113.4666667'],
            ['id' => '3529', 'province_id' => '35', 'name' => 'KABUPATEN SUMENEP', 'latitude' => '-6.9253999', 'longitude' => '113.9060624'],
            ['id' => '3571', 'province_id' => '35', 'name' => 'KOTA KEDIRI', 'latitude' => '-7.809356', 'longitude' => '112.032356'],
            ['id' => '3572', 'province_id' => '35', 'name' => 'KOTA BLITAR', 'latitude' => '-8.1014419', 'longitude' => '112.162762'],
            ['id' => '3573', 'province_id' => '35', 'name' => 'KOTA MALANG', 'latitude' => '-8.0495643', 'longitude' => '112.6884549'],
            ['id' => '3574', 'province_id' => '35', 'name' => 'KOTA PROBOLINGGO', 'latitude' => '-7.753965', 'longitude' => '113.210675'],
            ['id' => '3575', 'province_id' => '35', 'name' => 'KOTA PASURUAN', 'latitude' => '-7.64487200', 'longitude' => '112.90329700'],
            ['id' => '3576', 'province_id' => '35', 'name' => 'KOTA MOJOKERTO', 'latitude' => '-7.488075', 'longitude' => '112.427027'],
            ['id' => '3577', 'province_id' => '35', 'name' => 'KOTA MADIUN', 'latitude' => '-7.629714', 'longitude' => '111.513702'],
            ['id' => '3578', 'province_id' => '35', 'name' => 'KOTA SURABAYA', 'latitude' => '-7.289166', 'longitude' => '112.734398'],
            ['id' => '3579', 'province_id' => '35', 'name' => 'KOTA BATU', 'latitude' => '-7.8671', 'longitude' => '112.5239'],
        ];

        foreach ($kotaData as $data) {
            DB::table('regencies')->updateOrInsert(
                ['id' => $data['id']],
                [
                    'province_id' => $data['province_id'],
                    'name' => $data['name'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude']
                ]
            );
        }
    }
}
