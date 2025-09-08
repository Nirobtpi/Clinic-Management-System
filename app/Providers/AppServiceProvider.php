<?php

namespace App\Providers;


use Carbon\Carbon;
use Hamcrest\Core\Set;
use App\Models\StripePayment;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Modules\Language\App\Models\Language;

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
        Session::put('admin_lang', 'en');

        // PHP এর default timezone set
        date_default_timezone_set('Asia/Dhaka');

        View::composer('*', function ($view) {

            $languages=Language::where('status','active')->get();

            $difaultLang = Language::where('default', 1)->first();
            if ($difaultLang) {
                Session::put('admin_lang', $difaultLang->code);
                App::setLocale($difaultLang->code);
            }


            $view->with('languages', $languages);
        });
    }
}

