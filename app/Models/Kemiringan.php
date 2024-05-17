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
        'kemiringan',
        'luas'
    ];
}
