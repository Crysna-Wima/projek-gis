<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasMenu extends Model
{
    use HasFactory;

    protected $table='roles_has_menu';
    protected $fillable=['role_id','menu_id','created_at','updated_at',];
}
