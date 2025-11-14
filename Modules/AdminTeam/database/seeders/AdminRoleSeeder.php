<?php

namespace Modules\AdminTeam\Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Modules\AdminTeam\App\Models\AdminRole;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Admin',
                'description' => 'Has full access to all system features and settings.',
                'status' => 'active',
                'is_system_role' => true,
            ],
        ];

        foreach ($roles as $role) {
            AdminRole::create($role);
        }
        $admin=Admin::where('super_admin',1)->first();
        $admin->adminroles()->attach(AdminRole::where('name','super_admin')->first());
    }
}
