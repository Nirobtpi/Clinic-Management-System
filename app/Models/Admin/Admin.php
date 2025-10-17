<?php

namespace App\Models\Admin;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasRoles, Notifiable;
    protected $guarded=[];

    public function isSuperAdmin()
    {
        return $this->super_admin == 1;
    }
}
