<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irigasi extends Model
{
    use HasFactory;

    protected $table = 't_irigasi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kota',
        'tahun',
        'id_jenis_irigasi',
        'luas'
    ];

    public $timestamps = false;

    public function kota()
    {
        return $this->belongsTo(Regency::class, 'id_kota', 'id');
    }

    public function jenis_irigasi()
    {
        return $this->belongsTo(Jenis_Irigasi::class, 'id_jenis_irigasi', 'id');
    }

}
