<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminTeam\Http\Controllers\AdminTeamController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('adminteams', AdminTeamController::class)->names('adminteam');
});
