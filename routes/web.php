<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::middleware(['isAdmin'])->group(function () {
//     Route::get('/dashboard', function () {
//         return 'Dashboard';
//     });

// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');