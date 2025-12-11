<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
    ];

    public function incrementBalance($value = 0): void
    {
        $this->increment('amount', $value);
    }

    public function decrementBalance($value = 0): void
    {
        $this->decrement('amount', $value);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
