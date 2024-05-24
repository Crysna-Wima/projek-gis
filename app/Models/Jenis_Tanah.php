<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_Tanah extends Model
{
    use HasFactory;
    protected $table = 'jenis__tanahs';
    protected $primaryKey = 'id';
    public $incrementing = false; // because it's a char type, not an auto-incrementing integer
    protected $keyType = 'char'; // ensures Eloquent treats the primary key as a string

    public $timestamps = false;
}
