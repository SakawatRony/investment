<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralUser extends Model
{
   protected $fillable = [
        'user_id',
        'referral_id',
        'unit_user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function refer()
    {
        return $this->belongsTo('App\Models\User', 'referral_id');
    }

    public function unitUser()
    {
        return $this->belongsTo('App\Models\UnitUser', 'unit_user_id');
    }
}
