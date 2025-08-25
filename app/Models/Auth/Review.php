<?php

namespace App\Models\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class)->where('role', 'user');
    }
    public function doctor()
    {
        return $this->belongsTo(User::class)->where('role', 'doctor')->where('is_active', 1);
    }
}
