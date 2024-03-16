<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MauXe extends Model
{
    use HasFactory;
    protected $table = "mau_xe";
    
    public function xe() {
        return $this->belongsTo('App\Models\Xe', 'idXe', 'id');
    }
}
