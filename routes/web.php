<?php

use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Export\AllExportController;
use App\Models\User;
use App\Models\Payment;
use App\Models\Admin\Admin;
use App\Models\Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\loginController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Auth\ReviewController;
use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DoctorsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Doctor\SocialMediaController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Doctor\DoctorLogInfoController;
use App\Http\Controllers\Doctor\DoctorProfileController;
use App\Http\Controllers\Doctor\ScheduleTimingController;
use App\Http\Controllers\Doctor\DoctorDashboardController;
use App\Http\Controllers\Auth\UserController as AuthUserController;
use App\Http\Controllers\Email\ForgetPasswordController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

Route::get('/',[DashboardController::class,'index'])->name('home');
Route::get('user/login',[loginController::class,'loginPage'])->name('user.login')->middleware('guest:web');
Route::get('user/register',[loginController::class,'registerPage'])->name('user.register');
Route::get('doctor/register',[DoctorLogInfoController::class,'registerPage'])->name('doctor.register');
Route::post('doctor/register',[DoctorLogInfoController::class,'register'])->name('doctor.register.post');
Route::post('user/login',[loginController::class,'login'])->name('user.login.post');
Route::get('logout',[loginController::class,'logout'])->name('user.logout')->middleware('auth:web');



Route::middleware(['auth:web','login.cache'])->prefix('auth')->group(function () {
    Route::group(['prefix' => 'doctor'], function () {

        Route::get('/',[DoctorDashboardController::class,'dashboard'])->name('doctor.dashboard');
        Route::get('profile/view',[DoctorProfileController::class,'profile'])->name('doctor.profile');

        Route::get('get-city/{id}',[DoctorProfileController::class,'getCity'])->name('doctor.get.city');
        Route::get('get-state/{id}',[DoctorProfileController::class,'getState'])->name('doctor.get.state');

        // update profile route
        Route::put('profile/update/{id}',[DoctorProfileController::class,'update'])->name('doctor.profile.update');
        Route::post('profile/update/{id}',[DoctorProfileController::class,'DoctorProfileUpdate'])->name('doctor.profile.update.post');
        Route::resource('schedule', ScheduleTimingController::class);
        Route::get('schedule/update/data/{day}', [ScheduleTimingController::class, 'scheduleUpdate'])->name('schedule.update.data');
        Route::resource('social-medai',SocialMediaController::class)->names('doctor.socialmedia');
        Route::get('reviews',[ReviewController::class,'index'])->name('doctor.reviews');
        Route::get('review/{id}',[ReviewController::class,'statusUpdate'])->name('status.update');

        // Appointment status manage route
        Route::get('appointment/status/{id}',[DoctorDashboardController::class,'appointmentStatus'])->name('doctor.appointment.status');
        Route::get('appointment/cancel/{id}',[DoctorDashboardController::class,'appointmentCancel'])->name('doctor.appointment.cancel');
        Route::get('all-appointment',[DoctorDashboardController::class,'allAppointment'])->name('doctor.all.appointment');
        Route::get('appointment/{id}',[DoctorDashboardController::class,'appointmentView'])->name('doctor.appointment.view');
        Route::get('my-patient',[DoctorDashboardController::class,'myPatient'])->name('doctor.my.patient');


    });

    // all user route
    Route::get('change-password',[AuthUserController::class,'changePasswordPage'])->name('change.password');
    Route::put('password/update/{id}',[AuthUserController::class,'passwordUpdate'])->name('password.update');

    // user route
    Route::prefix('user')->group(function () {
        Route::get('/',[UserDashboardController::class,'dashboard'])->name('user.dashboard');
        Route::get('profile/view',[UserProfileController::class,'profileView'])->name('user.profile');
        Route::put('profile/update/{id}',[UserProfileController::class,'profileUpdate'])->name('user.update');
        Route::post('review/store/{id}',[ReviewController::class,'reviewStore'])->name('review.store');
        Route::get('booking/{id}',[DashboardController::class,'booking'])->name('user.doctor.appointment');
        Route::post('booking/{id}/store',[DashboardController::class,'bookingStore'])->name('user.booking.store');
        Route::get('checkout',[DashboardController::class,'checkout'])->name('user.checkout');

        // stripe payment
        Route::post('stripe/post',[stripeController::class,'stripe_post'])->name('stripe.post');
        Route::get('success',[StripeController::class,'success'])->name('payment.success');
        Route::get('cancle',[StripeController::class,'cancle'])->name('payment.cancel');

        // mollie payment
        Route::get('mollie/payment/{id}',[PaymentController::class,'molliePayment'])->name('mollie.payment');
        Route::get('/mollie/callback', [PaymentController::class, 'mollieCallback'])->name('mollie.callback');

        // check time

        Route::get('check-time/{id}',[DashboardController::class,'checkTime'])->name('user.check.time');

        // cart controller
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
        Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


    });
});

Route::prefix('user')->group(function(){
    Route::get('doctor/{id}/proofile/view',[DashboardController::class,'doctorProfileView'])->name('user.doctor.profile');
    Route::get('checkday/{id}',[DashboardController::class,'checkDay'])->name('user.checkday');
});


// user route
Route::post('user/register',[loginController::class,'register'])->name('user.register.post');






// admin route

Route::get('admin/login',[AdminLoginController::class,'loginPage'])->name('admin.login')->middleware('guest:admin');
Route::post('admin/login',[AdminLoginController::class,'login'])->name('admin.login.post');

Route::controller(ForgetPasswordController::class)->group(function () {
    Route::get('user/forget-password','showForgetPasswordForm')->name('user.forget.password');
    Route::get('user/reset-password-page','showResetPasswordForm')->name('user.reset.password');
    Route::post('user/pasword-reset','submitForgetPasswordForm')->name('user.forget.password.post');
    Route::put('user/reset-password','submitResetPasswordForm')->name('user.reset.password.post');
});

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

    Route::get('stripe-config',[StripeController::class,'index'])->name('stripe.config');
    Route::put('stripe-config/update',[StripeController::class,'update'])->name('stripe.update');

    // team route

    Route::resource('team',TeamMemberController::class);

    // role route
    Route::get('role',[TeamMemberController::class,'role'])->name('role.index');
    Route::get('role-add',[TeamMemberController::class,'role_add'])->name('role.add');
    Route::post('role-store',[TeamMemberController::class,'role_store'])->name('role.store');
    Route::get('role-edit/{id}',[TeamMemberController::class,'role_edit'])->name('role.edit');
    Route::put('role-edit/{id}',[TeamMemberController::class,'role_update'])->name('role.update');
    Route::delete('role-delete/{id}',[TeamMemberController::class,'role_delete'])->name('role.delete');

    Route::get('role-assain-user/{id}',[TeamMemberController::class,'assign_role_user'])->name('team.permission');
    Route::post('role-assain-user/{id}',[TeamMemberController::class,'assign_role_user_store'])->name('team.role.store');

    // permission route
    Route::get('permission',[TeamMemberController::class,'permission'])->name('permission.index');
    Route::get('permission-add',[TeamMemberController::class,'permission_add'])->name('permission.add');
    Route::post('permission-store',[TeamMemberController::class,'permission_store'])->name('permission.store');
    Route::get('permission-edit/{id}',[TeamMemberController::class,'permission_edit'])->name('permission.edit');
    Route::put('permission-edit/{id}',[TeamMemberController::class,'permission_update'])->name('permission.update');
    Route::delete('permission-delete/{id}',[TeamMemberController::class,'permission_delete'])->name('permission.delete');

    Route::controller(AllExportController::class)->group(function () {
        Route::get('export-import','import_export_country')->name('export.country');
        Route::get('export-import/download','import_export_country_download')->name('export.country.download');
        Route::get('export/download','sample_data')->name('export.sample.data');
        Route::post('import','import_export_country_store')->name('import.country');
    });

    Route::controller(EmailController::class)->group(function () {
        Route::get('email-configaration','index')->name('email.index');
        Route::post('email-configaration','update')->name('email.update');
        Route::get('email-template','emailTemplate')->name('email.template');
        Route::get('email-template-edit/{id}','emailTemplateEdit')->name('email.template.edit');
        Route::put('email-template-update/{id}','emailTemplateUpdate')->name('email.template.update');
    });

});


// SSLCommerz
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);


Route::get('/test-lang', function () {
//    return File::get(base_path('lang/en/messages.php'));
    return generateLangPhp();

});
