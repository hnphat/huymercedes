<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = "slider";

    public function tinXe() {
        return $this->hasOne('App\Models\TinXe','id', 'baiViet');
    }

    public function tinTuc() {
        return $this->hasOne('App\Models\TinTuc','id', 'baiViet');
    }
}
