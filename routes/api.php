<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BukuController;
use App\Http\Controllers\Api\V1\PeminjamanController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\OpenLibraryController;

Route::prefix('v1')->group(function () {

    // Autentikasi
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        // API sirkulasi peminjaman
        Route::post('/peminjamans', [PeminjamanController::class, 'store']);
        Route::post('/peminjamans/{id}/pengembalian', [
            PeminjamanController::class,
            'returnBook'
        ]);
    });

    // API katalog buku (publik)
    Route::get('/bukus', [BukuController::class, 'index']);
    Route::get('/bukus/{id}', [BukuController::class, 'show']);

    // API pencarian buku melalui OpenLibrary
    Route::get('/openlibrary/{isbn}', [OpenLibraryController::class, 'show']);
});

// Endpoint informasi pengguna terautentikasi
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});