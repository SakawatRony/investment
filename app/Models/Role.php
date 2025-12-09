<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function scopeNotId($query)
    {
        return $query->where('id','!=', '1');
    }
}
