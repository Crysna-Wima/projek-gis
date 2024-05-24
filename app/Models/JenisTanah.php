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
        'id_jenis_tanah',
        'luas'
    ];

    public $timestamps = false;

    public function kota()
    {
        return $this->belongsTo(Regency::class, 'id_kota', 'id');
    }

    public function jenistanah()
    {
        return $this->belongsTo(Jenis_Tanah::class, 'id_jenis_tanah', 'id');
    }
}
