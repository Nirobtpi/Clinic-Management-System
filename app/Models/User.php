<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Doctor\SocialMedia;
use Illuminate\Support\Facades\App;
use App\Models\Doctor\ScheduleTiming;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function appointments(){
        return $this->hasMany(Appointment::class,'user_id');
    }
    public function patients(){
        return $this->hasMany(Appointment::class,'doctor_id');
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id', 'id');
    }

    public function socialMedia(){
        return $this->hasMany(SocialMedia::class);
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function getCityNameAttribute(){
        return $this?->city?->name;
    }
    public function getStateNameAttribute(){
        return $this?->state?->name;
    }
    public function getCountryNameAttribute(){
        return $this?->country?->name;
    }
    public function scheduleTimings(){
        return $this->hasMany(ScheduleTiming::class);
    }
    public function profile(){
        return $this->hasOne(DoctorProfile::class, 'user_id', 'id');
    }
    public function clinics(){
        return $this->hasMany(Clinic::class);
    }
}
