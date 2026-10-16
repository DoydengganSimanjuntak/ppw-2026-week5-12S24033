<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

// Halaman awal
Route::get('/', function () {
    return redirect()->route('buku.index');
});

// Login dan logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Halaman yang hanya boleh diakses setelah login
Route::middleware('auth')->group(function () {
    // Pengelolaan kategori dan buku
    Route::resource('kategori', KategoriController::class);
    Route::resource('buku', BukuController::class);

    // Transaksi peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');

    Route::post('/buku/{bukuId}/pinjam', [
        PeminjamanController::class,
        'pinjam'
    ])->name('buku.pinjam');

    // Transaksi pengembalian
    Route::post('/peminjaman/{id}/kembali', [
        PeminjamanController::class,
        'kembali'
    ])->name('peminjaman.kembali');
});