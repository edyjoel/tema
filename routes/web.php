<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/forgot-password', function () {
    return redirect()->route('admin.dashboard');
});

//Route::middleware('web', 'auth:sanctum', config('jetstream.auth_session'), 'verified')

//Route::middleware('web', 'auth:sanctum', config('jetstream.auth_session'), 'verified')


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['can:admin.dashboard', 'web', 'auth', config('jetstream.auth_session'), 'verified'])
    ->name('admin.dashboard');
