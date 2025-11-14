<?php

namespace Modules\AdminTeam\Models;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminTeamPermissionList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'display_name',
        'module',
        'description',
        'parent_id',
        'is_group',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(AdminTeamPermissionList::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(AdminTeamPermissionList::class, 'parent_id');
    }

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class,
            'admin_role_permissions',
            'admin_team_permission_id',
            'admin_role_id'
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
