<?php

namespace Modules\AdminTeam\App\Models;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\AdminTeam\Database\Factories\AdminRoleFactory;

class AdminRole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany(
            AdminTeamPermissionList::class,
            'admin_role_permissions',
            'admin_role_id',
            'admin_team_permission_id'
        );
    }

    public function admins()
    {
        return $this->belongsToMany(
            Admin::class,
                'admin_role_assignments',
                'admin_role_id',
                'admin_id'
            );
    }

}
