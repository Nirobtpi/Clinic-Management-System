<?php

namespace App\Models\Doctor;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ScheduleTiming extends Model
{
    protected $guarded = [];
    // protected $casts = [
    //     'start_time' => 'array',
    //     'end_time' => 'array',
    // ];

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
}
