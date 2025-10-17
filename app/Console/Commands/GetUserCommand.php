<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-user-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
          $users = User::all();

        // Console output (pretty format)
        $this->info("Total Users: " . $users->count());
        $this->line("User List:");
        $this->line($users->toJson(JSON_PRETTY_PRINT));

        // Log in file
        Log::info('User command executed at: ' . now());
        Log::info('Users:', $users->toArray());

        // Indicate success
        $this->info('✅ User command executed successfully!');

        return 0;

    }
}
