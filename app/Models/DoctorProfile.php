<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    protected $guarded = [];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
