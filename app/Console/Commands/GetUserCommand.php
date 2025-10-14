<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

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
        $user = User::select('name')->get();

        $this->info($user);

    }
}
