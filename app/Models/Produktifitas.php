<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produktifitas extends Model
{
    use HasFactory;

    protected $table = 't_produktifitas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kota',
        'tahun',
        'masa_panen',
        'produktifitas'
    ];

    public function kota()
    {
        return $this->belongsTo(Regency::class, 'id_kota', 'id');
    }
}
