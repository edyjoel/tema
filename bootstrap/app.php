<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // add new route file for admin and middleware auth:sanctum jetstream.auth_session verified
        then: function () {
            Route::namespace('Admin')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'))
                ->middleware([
                    'web',
                    'auth:sanctum',
                    config('jetstream.auth_session'),
                    'verified',
                ]);
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
