<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\AdminTeam\Database\Seeders\AdminTeamDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // // ]);
        // Admin::create([
        //     "name"=> "admin",
        //     "email"=> "admin@gmail.com",
        //     "password"=> Hash::make("1234"),

        // ]);
    }
}
