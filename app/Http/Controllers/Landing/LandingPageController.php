<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\CurahHujan;
use App\Models\Regency;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(('home.index'));
    }

    public function tentangkami(){
        return view(('home.tentang-kami'));
    }

    public function curahhujan(){
        $tahun_now = date('Y');
        $bulan_now = ltrim(date('m'), '0');

        // Array untuk memetakan angka bulan ke nama bulan
        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $data['tahun_now'] = $tahun_now;
        $data['bulan_now'] = $namaBulan[$bulan_now];
        $data['jumlah_kota'] = Regency::where('province_id', '35')->count();

        // rata-rata curah hujan bulan ini tahun ini (2 digit dibelakang koma)
        $data['intensitas_hujan'] = round(CurahHujan::where('tahun', $tahun_now)->where('bulan', $bulan_now)->avg('curah_hujan'), 2);
        $data['curah_hujan_tertinggi'] = CurahHujan::where('tahun', $tahun_now)->where('bulan', $bulan_now)->max('curah_hujan');
        $data['curah_hujan_terendah'] = CurahHujan::where('tahun', $tahun_now)->where('bulan', $bulan_now)->min('curah_hujan');

        $data['curah_hujan'] = CurahHujan::with('kota')->where('tahun', $tahun_now)->where('bulan', $bulan_now)->get();

        return view('home.data.curah-hujan', $data);
    }
}
