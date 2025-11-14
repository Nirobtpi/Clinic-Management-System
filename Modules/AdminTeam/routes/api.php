<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminTeam\Http\Controllers\AdminTeamController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('adminteams', AdminTeamController::class)->names('adminteam');
});
