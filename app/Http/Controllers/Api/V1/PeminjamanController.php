<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PeminjamanController extends Controller
{
    /**
     * Membuat peminjaman buku.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => ['required', 'integer', 'exists:bukus,id'],
            'nim_peminjam' => ['required', 'string', 'max:255'],
            'nama_peminjam' => ['required', 'string', 'max:255'],
            'tanggal_pinjam' => ['required', 'date'],
            'tanggal_jatuh_tempo' => [
                'required',
                'date',
                'after_or_equal:tanggal_pinjam',
            ],
        ]);

        $peminjaman = DB::transaction(function () use ($validated) {

            $buku = Buku::where('id', $validated['buku_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($buku->stok <= 0) {
                abort(422, 'Stok buku tidak tersedia.');
            }

            $buku->decrement('stok');

            return Peminjaman::create([
                'kode_pinjam' => 'PJM-' . strtoupper(Str::random(8)),
                'buku_id' => $buku->id,
                'nim_peminjam' => $validated['nim_peminjam'],
                'nama_peminjam' => $validated['nama_peminjam'],
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_jatuh_tempo' => $validated['tanggal_jatuh_tempo'],
                'tanggal_kembali' => null,
                'status' => 'dipinjam',
            ]);
        });

        return response()->json([
            'message' => 'Peminjaman buku berhasil.',
            'data' => $peminjaman->load('buku'),
        ], 201);
    }

    /**
     * Mengembalikan buku.
     */
    public function returnBook(string $id)
    {
        $peminjaman = DB::transaction(function () use ($id) {

            $peminjaman = Peminjaman::where('id', $id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($peminjaman->status !== 'dipinjam') {
                abort(409, 'Peminjaman ini sudah dikembalikan.');
            }

            $buku = Buku::where('id', $peminjaman->buku_id)
                ->lockForUpdate()
                ->firstOrFail();

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_kembali' => now()->toDateString(),
            ]);

            $buku->increment('stok');

            return $peminjaman;
        });

        return response()->json([
            'message' => 'Buku berhasil dikembalikan.',
            'data' => $peminjaman->load('buku'),
        ]);
    }
}