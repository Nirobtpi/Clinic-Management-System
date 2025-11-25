<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
        ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth'=> \App\Http\Middleware\Authenticate::class,
            'guest'=> \App\Http\Middleware\AdminRedirectMiddleware::class,
            'login.cache'=> \App\Http\Middleware\LoginCacheMiddelware::class,
            'set.front.lang' => \App\Http\Middleware\SetFrontendLanguage::class,

        ]);
        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \App\Http\Middleware\SetFrontendLanguage::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
