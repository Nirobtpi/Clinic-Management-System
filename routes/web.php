<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login',[AdminLoginController::class,'loginPage'])->name('login');
Route::post('admin/login',[AdminLoginController::class,'login'])->name('admin.login.post');

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/',[AdminDashboardController::class,'index'])->name('admin.dashboard');
    Route::get('logout',[AdminLoginController::class,'logout'])->name('admin.logout');

    // profile route
    Route::get('profile',[ProfileController::class,'profile'])->name('admin.profile');
    Route::put('profile/update',[ProfileController::class,'update'])->name('admin.profile.update');
});
