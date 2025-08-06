<?php

use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AppointmentControlle;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\AdminDashboardController;

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
    Route::put('profile/update/{id}',[ProfileController::class,'update'])->name('admin.profile.update');
    Route::put('password/update/{id}',[ProfileController::class,'passwordUpdate'])->name('admin.password.update');

    Route::resource('appointment',AppointmentControlle::class);
    Route::resource('departments',DepartmentController::class);

});
