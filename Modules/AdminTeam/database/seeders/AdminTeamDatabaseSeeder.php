<?php

namespace Modules\AdminTeam\Database\Seeders;

use Illuminate\Database\Seeder;


class AdminTeamDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AdminTeamPermissionListSeeder::class,
            AdminRoleSeeder::class,
        ]);
    }
}
