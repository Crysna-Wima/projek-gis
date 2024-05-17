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
        'jenis_irigasi',
        'luas'
    ];
}
