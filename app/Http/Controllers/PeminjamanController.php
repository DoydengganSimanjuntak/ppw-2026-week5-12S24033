<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar transaksi peminjaman.
     */
    public function index()
    {
        $peminjamans = Peminjaman::with('buku')
            ->latest()
            ->paginate(10);

        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Memproses peminjaman buku.
     */
    public function pinjam(Request $request, $bukuId)
    {
        $data = $request->validate([
            'nim_peminjam' => 'required|string|max:30',
            'nama_peminjam' => 'required|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($data, $bukuId) {
                $buku = Buku::where('id', $bukuId)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($buku->stok <= 0) {
                    throw new RuntimeException(
                        'Stok buku habis. Peminjaman ditolak.'
                    );
                }

                $sudahMeminjam = Peminjaman::where(
                    'buku_id',
                    $buku->id
                )
                    ->where('nim_peminjam', $data['nim_peminjam'])
                    ->where('status', 'dipinjam')
                    ->exists();

                if ($sudahMeminjam) {
                    throw new RuntimeException(
                        'Kamu masih meminjam buku ini dan belum mengembalikannya.'
                    );
                }

                $buku->decrement('stok');

                Peminjaman::create([
                    'kode_pinjam' => 'PJM-' . Str::upper(Str::random(10)),
                    'buku_id' => $buku->id,
                    'nim_peminjam' => $data['nim_peminjam'],
                    'nama_peminjam' => $data['nama_peminjam'],
                    'tanggal_pinjam' => now()->toDateString(),
                    'tanggal_jatuh_tempo' => now()
                        ->addDays(7)
                        ->toDateString(),
                    'status' => 'dipinjam',
                ]);
            });

            // Simpan identitas peminjam terakhir setelah transaksi berhasil.
            $request->session()->put([
                'peminjam_terakhir' => $data['nama_peminjam'],
                'nim_peminjam_terakhir' => $data['nim_peminjam'],
            ]);

            return back()->with(
                'success',
                'Peminjaman buku berhasil.'
            );
        } catch (RuntimeException $e) {
            return back()->withErrors([
                'peminjaman' => $e->getMessage(),
            ]);
        } catch (QueryException $e) {
            Log::error('Gagal memproses peminjaman buku.', [
                'buku_id' => $bukuId,
                'error' => $e->getMessage(),
            ]);

            return back()->withErrors([
                'peminjaman' => 'Terjadi kesalahan database. Silakan coba lagi.',
            ]);
        }
    }

    /**
     * Memproses pengembalian buku.
     */
    public function kembali($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $peminjaman = Peminjaman::where('id', $id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($peminjaman->status === 'dikembalikan') {
                    throw new RuntimeException(
                        'Buku ini sudah dikembalikan.'
                    );
                }

                $buku = Buku::where('id', $peminjaman->buku_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $peminjaman->update([
                    'status' => 'dikembalikan',
                    'tanggal_kembali' => now()->toDateString(),
                ]);

                $buku->increment('stok');
            });

            return back()->with(
                'success',
                'Buku berhasil dikembalikan.'
            );
        } catch (RuntimeException $e) {
            return back()->withErrors([
                'peminjaman' => $e->getMessage(),
            ]);
        } catch (QueryException $e) {
            Log::error('Gagal memproses pengembalian buku.', [
                'peminjaman_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->withErrors([
                'peminjaman' => 'Terjadi kesalahan database. Silakan coba lagi.',
            ]);
        }
    }
}