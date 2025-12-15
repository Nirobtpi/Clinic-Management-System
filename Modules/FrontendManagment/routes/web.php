<?php

use Illuminate\Support\Facades\Route;
use Modules\FrontendManagment\App\Http\Controllers\FrontendManagmentController;

Route::middleware(['auth:admin'])->group(function () {

    Route::get('admin/frontendmanagments', [FrontendManagmentController::class, 'index'])->name('frontendmanagment');
    Route::get('admin/frontendmanagments/{frontendmanagment}/edit', [FrontendManagmentController::class, 'edit'])->name('frontendmanagment.edit');
    Route::put('admin/frontendmanagments/{frontendmanagment}/{id?}', [FrontendManagmentController::class, 'update'])->name('frontendmanagment.update');
});
