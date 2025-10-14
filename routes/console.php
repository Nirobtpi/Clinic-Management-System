<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('users', function () {
    $this->comment(\App\Models\User::all());
})->purpose('Display an inspiring quote')->everyThreeMinutes();
