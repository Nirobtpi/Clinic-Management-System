<?php

use Illuminate\Support\Facades\Route;
use Modules\FrontendManagment\Http\Controllers\FrontendManagmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('frontendmanagments', FrontendManagmentController::class)->names('frontendmanagment');
});
