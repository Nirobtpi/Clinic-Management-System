<?php

namespace Modules\AdminTeam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\AdminTeam\Database\Factories\AdminRoleAssignmentFactory;

class AdminRoleAssignment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    // protected static function newFactory(): AdminRoleAssignmentFactory
    // {
    //     // return AdminRoleAssignmentFactory::new();
    // }
}
