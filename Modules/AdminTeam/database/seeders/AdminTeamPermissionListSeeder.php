<?php

namespace Modules\AdminTeam\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\AdminTeam\App\Models\AdminTeamPermissionList;

class AdminTeamPermissionListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Dashboard Management
            [
                'name' => 'dashboard_management',
                'display_name' => 'Dashboard Management',
                'module' => 'dashboard',
                'description' => 'Access to dashboard and main admin panel',
                'parent_id' => null,
                'is_group' => true,
                'status' => 'active',
            ],
            [
                'name' => 'view_dashboard',
                'display_name' => 'View Dashboard',
                'module' => 'dashboard',
                'description' => 'Permission to view the dashboard',
                'parent_id' => null,
                'is_group' => false,
                'status' => 'active',
            ],
            [
                'name' => 'edit_dashboard',
                'display_name' => 'Edit Dashboard',
                'module' => 'dashboard',
                'description' => 'Permission to edit dashboard settings',
                'parent_id' => null,
                'is_group' => false,
                'status' => 'active',
            ],
             [
                'name' => 'profile_management',
                'display_name' => 'Profile Management',
                'module' => 'profile',
                'description' => 'Edit admin profile',
                'parent_id' => null,
                'is_group' => true,
                'status' => 'active',
            ],
            [
                'name' => 'profile_edit',
                'display_name' => 'Edit Profile Management',
                'module' => 'profile',
                'description' => 'Edit admin profile',
                'parent_id' => null,
                'is_group' => false,
                'status' => 'active',
            ],
            [
                'name' => 'dashboard_update_password',
                'display_name' => 'Update Password',
                'module' => 'profile',
                'description' => 'Update admin password',
                'parent_id' => null,
                'is_group' => false,
                'status' => 'active',
            ],
            [
                'name' => 'blog_management',
                'display_name' => 'Blog Management',
                'module' => 'blog',
                'description' => 'Manage blog posts and categories',
                'parent_id' => null,
                'is_group' => true,
                'status' => 'active',
            ],
            [
                'name' => 'create_blog_post',
                'display_name' => 'Create Blog Post',
                'module' => 'blog',
                'description' => 'Permission to create blog posts',
                'parent_id' => null,
                'is_group' => false,
                'status' => 'active',
            ],
            [
                'name' => 'edit_blog_post',
                'display_name' => 'Edit Blog Post',
                'module' => 'blog',
                'description' => 'Permission to edit blog posts',
                'parent_id' => null,
                'is_group' => false,
                'status' => 'active',
            ],
            [
                'name' => 'delete_blog_post',
                'display_name' => 'Delete Blog Post',
                'module' => 'blog',
                'description' => 'Permission to delete blog posts',
                'parent_id' => null,
                'is_group' => false,
                'status' => 'active',
            ],
        ];

        $groupIds = [];
        foreach ($permissions as $index => $permission) {
            if ($permission['is_group']) {
                $createdPermission = AdminTeamPermissionList::updateOrCreate(
                    ['name' => $permission['name']],
                    $permission
                );
                $groupIds[$permission['name']] = $createdPermission->id;
            }
        }

        foreach ($permissions as $permission) {
            if (!$permission['is_group']) {
                $parentGroupName = $this->getParentGroupName($permission['module']);
                if (isset($groupIds[$parentGroupName])) {
                    $permission['parent_id'] = $groupIds[$parentGroupName];
                }

                AdminTeamPermissionList::updateOrCreate(
                    ['name' => $permission['name']],
                    $permission
                );
            }
        }
    }
    private function getParentGroupName($module){
        $groupMapping = [
            'dashboard' => 'dashboard_management',
            'profile' => 'profile_management',
            'blog' => 'blog_management',
            // Add more mappings as needed
        ];

        return isset($groupMapping[$module]) ? $groupMapping[$module] : null;
    }
}
