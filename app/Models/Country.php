<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function states()
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
