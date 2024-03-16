<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xe extends Model
{
    use HasFactory;
    protected $table = "xe";

    public function viTriXe() {
        return $this->hasMany('App\Models\ViTriXe','idXe','id');
    }

    public function tin() {
        return $this->hasOne('App\Models\TinXe','id', 'tinXe');
    }

    public function mau() {
        return $this->hasMany('App\Models\MauXe','idXe','id');
    }
}
