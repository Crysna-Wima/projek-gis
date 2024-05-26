<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kemiringan extends Model
{
    use HasFactory;

    protected $table = 't_kemiringan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kota',
        'id_kemiringan_wilayah',
        'luas'
    ];

    public $timestamps = false;

    public function kota()
    {
        return $this->belongsTo(Regency::class, 'id_kota', 'id');
    }

    public function kemiringanWilayah()
    {
        return $this->belongsTo(Kemiringan_Wilayah::class, 'id_kemiringan_wilayah', 'id');
    }
}
