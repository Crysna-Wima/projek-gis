<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTanah extends Model
{
    use HasFactory;

    protected $table = 't_jenis_tanah';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kota',
        'jenis_tanah',
        'luas'
    ];
}
