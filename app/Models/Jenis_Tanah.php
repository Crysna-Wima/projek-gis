<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_Tanah extends Model
{
    use HasFactory;
    protected $table = 'jenis__tanahs';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
