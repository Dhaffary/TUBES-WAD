<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PesananController;

// 1. Root Redirect
Route::get('/', function () { 
    return redirect()->route('login'); 
});

// 2. GUEST MIDDLEWARE (Akses sebelum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 3. AUTH MIDDLEWARE (Wajib login)
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- GRUP KHUSUS ADMIN ---
    Route::middleware(['role:admin'])->group(function () {
        // Rute Manajemen Layanan
        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
        Route::get('/layanan/create', [LayananController::class, 'create'])->name('layanan.create');
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');

        // Rute Manajemen Pengguna
        Route::resource('pelanggan', UserController::class);
        
        // Admin melihat daftar semua pesanan
        Route::get('/admin/pesanan', [PesananController::class, 'index'])->name('admin.pesanan.index');
    });

    // --- GRUP KHUSUS PELANGGAN ---
    Route::middleware(['role:pelanggan'])->group(function () {
        // Rute Pesanan Utama
        Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
        Route::get('/pesanan/buat', [PesananController::class, 'create'])->name('pesanan.create');
        Route::post('/pesanan/simpan', [PesananController::class, 'store'])->name('pesanan.store');
        
        // Rute Cetak & Invoice
        Route::get('/pesanan/{id}/invoice', [PesananController::class, 'cetakInvoice'])->name('pesanan.invoice');
        Route::get('/pesanan/cetak/{id}', [PesananController::class, 'cetak'])->name('pesanan.cetak');
    });
    
    // Rute Global untuk Update & Delete
    Route::put('/pesanan/{id}', [PesananController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');
});