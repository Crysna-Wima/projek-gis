<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table    = 'menu';
    protected $fillable = ['id', 'uuid', 'name', 'permission', 'url', 'order_no' ,'icon', 'parent_id', 'type', 'status', 'created_by', 'updated_by'];

    public function menuChilds()
    {
        return $this->hasMany("App\Models\Menu", "parent_id", "id");
    }

    public function permissionmenu()
    {
        return $this->hasMany("App\Models\Permission","menu_id","id");
    }
}
