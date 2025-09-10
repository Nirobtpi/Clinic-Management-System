<?php

namespace App\Models\Admin;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasRoles;
    protected $guarded=[];

    public function isSuperAdmin()
    {
        return $this->super_admin == 1;
    }
}
