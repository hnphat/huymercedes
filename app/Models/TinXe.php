<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinXe extends Model
{
    use HasFactory;
    protected $table = "xe_tin";

    public function xe() {
        return $this->hasOne('App\Models\Xe','tinXe', 'id');
    }
}
