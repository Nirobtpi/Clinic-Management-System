<?php

use App\Models\User;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\loginController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DoctorsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\UserController as AuthUserController;
use App\Http\Controllers\Doctor\DoctorLogInfoController;
use App\Http\Controllers\Doctor\DoctorProfileController;
use App\Http\Controllers\Doctor\ScheduleTimingController;
use App\Http\Controllers\Doctor\SocialMediaController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

Route::get('/',[DashboardController::class,'index'])->name('home');
Route::get('user/login',[loginController::class,'loginPage'])->name('user.login');
Route::get('user/register',[loginController::class,'registerPage'])->name('user.register');
Route::get('doctor/register',[DoctorLogInfoController::class,'registerPage'])->name('doctor.register');
Route::post('doctor/register',[DoctorLogInfoController::class,'register'])->name('doctor.register.post');
Route::post('user/login',[loginController::class,'login'])->name('user.login.post');
Route::get('logout',[loginController::class,'logout'])->name('user.logout')->middleware('auth:web');



Route::middleware('auth:web')->prefix('auth')->group(function () {
    Route::group(['prefix' => 'doctor'], function () {

        Route::get('/',[DoctorLogInfoController::class,'dashboard'])->name('doctor.dashboard');
        Route::get('profile/view',[DoctorProfileController::class,'profile'])->name('doctor.profile');

        Route::get('get-city/{id}',[DoctorProfileController::class,'getCity'])->name('doctor.get.city');
        Route::get('get-state/{id}',[DoctorProfileController::class,'getState'])->name('doctor.get.state');

        // update profile route
        Route::put('profile/update/{id}',[DoctorProfileController::class,'update'])->name('doctor.profile.update');
        Route::post('profile/update/{id}',[DoctorProfileController::class,'DoctorProfileUpdate'])->name('doctor.profile.update.post');
        Route::resource('schedule', ScheduleTimingController::class);
        Route::get('schedule/update/data/{day}', [ScheduleTimingController::class, 'scheduleUpdate'])->name('schedule.update.data');
        Route::resource('social-medai',SocialMediaController::class)->names('doctor.socialmedia');


    });

    // all user route
    Route::get('change-password',[AuthUserController::class,'changePasswordPage'])->name('change.password');
    Route::put('password/update/{id}',[AuthUserController::class,'passwordUpdate'])->name('password.update');

    // user route
    Route::prefix('user')->group(function () {
        Route::get('/',[UserDashboardController::class,'dashboard'])->name('user.dashboard');
        Route::get('profile/view',[UserProfileController::class,'profileView'])->name('user.profile');
        Route::put('profile/update/{id}',[UserProfileController::class,'profileUpdate'])->name('user.update');
        Route::get('doctor/{id}/proofile/view',[DashboardController::class,'doctorProfileView'])->name('user.doctor.profile');

    });
});


// user route
Route::post('user/register',[loginController::class,'register'])->name('user.register.post');






// admin route

Route::get('admin/login',[AdminLoginController::class,'loginPage'])->name('admin.login');
Route::post('admin/login',[AdminLoginController::class,'login'])->name('admin.login.post');

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/',[AdminDashboardController::class,'index'])->name('admin.dashboard');
    Route::get('logout',[AdminLoginController::class,'logout'])->name('admin.logout');

    // profile route
    Route::get('profile',[ProfileController::class,'profile'])->name('admin.profile');
    Route::put('profile/update/{id}',[ProfileController::class,'update'])->name('admin.profile.update');
    Route::put('password/update/{id}',[ProfileController::class,'passwordUpdate'])->name('admin.password.update');

    Route::resource('appointment',AppointmentController::class);
    Route::resource('departments',DepartmentController::class);
    Route::resource('doctors',DoctorsController::class);
    Route::get('doctor/status/{id}', [DoctorsController::class, 'statusUpdate'])->name('doctor.status');

    Route::resource('users', UserController::class);
    Route::get('user/status/{id}', [UserController::class, 'statusUpdate'])->name('user.status');

    Route::resource('countries', CountryController::class);
    Route::resource('cities', CityController::class);
    Route::resource('states', StateController::class);
    Route::get('country/{id}/cities', [StateController::class, 'getCityByCountry'])->name('country.cities');

    Route::resource('clinics', ClinicController::class);

});
