<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurahHujan extends Model
{
    use HasFactory;

    protected $table = 't_curah_hujan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kota',
        'tahun',
        'bulan',
        'curah_hujan'
    ];
}
