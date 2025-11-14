<?php

namespace App\Models\Admin;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\AdminTeam\App\Models\AdminRole;
use Modules\AdminTeam\App\Models\AdminTeamPermissionList;

class Admin extends Authenticatable
{
    use HasRoles, Notifiable;
    protected $guarded=[];

    public function isSuperAdmin()
    {
        return $this->super_admin == 1;
    }

    /**
     * Relationship to module custom roles (AdminRole)
     * Pivot table: admin_role_assignments (admin_id, admin_role_id)
     */
    public function adminroles()
    {
        return $this->belongsToMany(
            AdminRole::class,
            'admin_role_assignments',
            'admin_id',
            'admin_role_id'
        );
    }

    public function hasPermission($permission)
    {
        $permissions = $this->getCachedPermissions();
        return in_array($permission, $permissions);
    }

    private function getCachedPermissions()
    {
        $cacheKey = "admin_permissions_{$this->id}";

        return cache()->remember($cacheKey, 3600, function () {
            // Super admin has all permissions
            if ($this->super_admin === 1) {
                return AdminTeamPermissionList::pluck('name')->toArray();
            }

            // Get all permissions through roles
            return $this->adminroles()->with('permissions')->get()
                ->pluck('permissions')
                ->flatten()
                ->pluck('name')
                ->unique()
                ->toArray();
        });
    }

    public function clearPermissionCache()
    {
        $cacheKey = "admin_permissions_{$this->id}";
        cache()->forget($cacheKey);
    }

    public function getAllPermissions()
    {
        $permissionNames = $this->getCachedPermissions();

        // Super admin has all permissions
        if ($this->super_admin === 1) {
            return AdminTeamPermissionList::all();
        }

        // Get permission models for cached permission names
        return AdminTeamPermissionList::whereIn('name', $permissionNames)->get();
    }

    /**
     * Get cached roles for this admin
     */
    private function getCachedRoles()
    {
        $cacheKey = "admin_roles_{$this->id}";

        return cache()->remember($cacheKey, 3600, function () {
            return $this->adminroles()->pluck('name')->toArray();
        });
    }

    /**
     * Clear cached roles for this admin
     */
    public function clearRoleCache()
    {
        $cacheKey = "admin_roles_{$this->id}";
        cache()->forget($cacheKey);
    }

    /**
     * Check if admin has a specific role
     */
    public function hasRole($role)
    {
        $roles = $this->getCachedRoles();
        return in_array($role, $roles);
    }

    /**
     * Check if admin has any of the given roles
     */
    public function hasAnyRole(array $roles)
    {
        $adminRoles = $this->getCachedRoles();
        return !empty(array_intersect($roles, $adminRoles));
    }

    /**
     * Clear all caches for this admin (permissions and roles)
     */
    public function clearAllCaches()
    {
        $this->clearPermissionCache();
        $this->clearRoleCache();
    }
}
