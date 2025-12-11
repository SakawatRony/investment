<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommission extends Model
{
    protected $fillable = [
        'to_user_id',
        'from_user_id',
        'from_refer_user_id',
        'unit_user_id',
        'commission',
    ];

    public function toUser()
    {
        return $this->belongsTo('App\Models\User', 'to_user_id');
    }

    public function fromUser()
    {
        return $this->belongsTo('App\Models\User', 'from_user_id');
    }

    public function fromReferUser()
    {
        return $this->belongsTo('App\Models\User', 'from_refer_user_id');
    }
}
