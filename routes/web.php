<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/admin', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');
