<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

// Route::get('/', function () {
    // return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');