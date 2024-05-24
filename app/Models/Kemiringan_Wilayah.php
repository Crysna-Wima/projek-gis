<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kemiringan_Wilayah extends Model
{
    protected $table = 'kemiringan__wilayahs';
    protected $primaryKey = 'id';
    public $incrementing = false; // because it's a char type, not an auto-incrementing integer
    protected $keyType = 'char'; // ensures Eloquent treats the primary key as a string

    public $timestamps = false;
}
