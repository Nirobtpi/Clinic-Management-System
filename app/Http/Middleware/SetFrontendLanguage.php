<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Language\App\Models\Language;

class SetFrontendLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $langCode = Session::get('front_lang');

        if (!$langCode || !Language::where('code', $langCode)->exists()) {
            // Try to detect country code via helper (may return null)
            $countryCode = function_exists('getDefaultLanguageByApi') ? getDefaultLanguageByApi() : null;

            Log::info('Country code detected: ' . ($countryCode ?? 'NULL'));

            $request_country = null;

            // if ($countryCode) {
            //     $request_country = Country::where('name', $countryCode)->first();
            // }

            // if (!$request_country) {
            //     $request_country = Country::where('is_default', true)->first();
            // }

            // if (!$request_country) {
            //     $request_country = Country::find(8);
            // }

            // If still no country found, avoid fatal error by skipping to default language
            $defaultLang = null;

            if (!$defaultLang) {
                $defaultLang = Language::find(1);
            }

            $langCode = $defaultLang->code ?? 'en';

            if ($defaultLang) {
                Session::put('front_lang', $defaultLang->code);
                Session::put('lang_dir', $defaultLang->lang_direction);
                Session::put('front_lang_name', $defaultLang->lang_name);

                // if ($request_country) {
                //     Session::put('front_lang_flag', $request_country->lang_flag);
                //     Session::put('request_country', $request_country->id);
                //     Session::put('request_country_name', $request_country->name);
                //     Session::put('request_country_flag', $request_country->lang_flag);
                // }

                app()->setLocale($defaultLang->code);
            }
        } else {
            app()->setLocale($langCode);
        }

        return $next($request);
    }
}
