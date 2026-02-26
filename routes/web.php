<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');

// --- KODE SAKTI PEMBUAT AKUN ADMIN ---
Route::get('/buat-admin', function () {
    User::updateOrCreate(
        ['email' => 'adminbaru@gmail.com'], // Ini email untuk login
        [
            'name' => 'Admin Baru',
            'password' => Hash::make('password123') // Ini password untuk login
        ]
    );

    return 'Sukses! Akun admin berhasil dibuat. Silakan kembali ke /admin/login';
});
// -------------------------------------