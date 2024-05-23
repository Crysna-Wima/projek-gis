<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_Irigasi extends Model
{
    protected $table = 'jenis__irigasis';
    protected $primaryKey = 'id';
    public $incrementing = false; // because it's a char type, not an auto-incrementing integer
    protected $keyType = 'char'; // ensures Eloquent treats the primary key as a string

    

}
