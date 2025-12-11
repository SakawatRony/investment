<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   protected $fillable = [
        'user_id',
        'price',
        'unit_user_id',
        'commission',
        'params',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function unitUser()
    {
        return $this->belongsTo('App\Models\UnitUser', 'unit_user_id');
    }

    public function userCommission()
    {
        return $this->belongsTo('App\Models\UserCommission', 'params');
    }
}
