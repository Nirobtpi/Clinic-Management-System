<?php

namespace App\Providers;


use Carbon\Carbon;
use App\Models\StripePayment;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('components.breadcrumb', 'breadcrumb');

        // PHP এর default timezone set
        date_default_timezone_set('Asia/Dhaka');
    }
}

