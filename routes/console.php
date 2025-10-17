<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('users', function () {
    $this->comment(\App\Models\User::all());
})->purpose('Display an inspiring quote')->everyThreeMinutes();

Schedule::command('app:get-user-command')->everyFiveSeconds();
