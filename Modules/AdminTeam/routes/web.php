<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminTeam\App\Http\Controllers\AdminTeamController;

Route::middleware(['auth:admin',])->group(function () {
    Route::resource('roles', AdminTeamController::class)->names('adminteam');
    Route::get('team-list', [AdminTeamController::class, 'team_list'])->name('adminteam.list');
    Route::get('role-list', [AdminTeamController::class, 'role_list'])->name('adminteam.role.list');
    Route::get('add-role/{id}', [AdminTeamController::class, 'add_roll'])->name('adminteam.add.role');
    Route::put('team-update/{id}', [AdminTeamController::class, 'admin_team_update'])->name('adminteam.update');
});
