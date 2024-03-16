<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;
    protected $table = "sub_menu";

    public function menu() {
        return $this->belongsTo('App\Models\Menu', 'idMenu', 'id');
    }

    public function tin() {
        return $this->hasOne('App\Models\TinTuc','id', 'baiViet');
    }
}
