<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class OpenLibraryController extends Controller
{
    /**
     * Mencari informasi buku berdasarkan ISBN
     * melalui OpenLibrary API.
     */
    public function show(string $isbn)
    {
        $response = Http::timeout(10)
            ->get("https://openlibrary.org/isbn/{$isbn}.json");

        if ($response->failed()) {
            return response()->json([
                'message' => 'Data buku tidak ditemukan di OpenLibrary.',
            ], 404);
        }

        $data = $response->json();

        return response()->json([
            'message' => 'Data buku berhasil ditemukan.',
            'data' => [
                'isbn' => $isbn,
                'judul' => $data['title'] ?? null,
                'jumlah_halaman' => $data['number_of_pages'] ?? null,
                'tanggal_terbit' => $data['publish_date'] ?? null,
                'penerbit' => $data['publishers'] ?? [],
            ],
        ]);
    }
}