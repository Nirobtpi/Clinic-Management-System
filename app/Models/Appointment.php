<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }

    public function clinic(){
        return $this->belongsTo(Clinic::class,'clinic_id');
    }
}
