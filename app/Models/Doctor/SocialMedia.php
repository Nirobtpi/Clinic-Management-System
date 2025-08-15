<?php

namespace App\Models\Doctor;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
}
