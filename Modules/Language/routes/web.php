<?php

use Illuminate\Support\Facades\Route;
use Modules\Language\App\Http\Controllers\LanguageController;

Route::middleware(['auth:admin'])->group(function () {
    Route::resource('languages', LanguageController::class)->names('language');
    Route::get('theme-language', [LanguageController::class, 'themeLanguage'])->name('theme-language');
    Route::post('theme-language', [LanguageController::class, 'themeLanguageUpdate'])->name('theme-language.update');
});
