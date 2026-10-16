<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query(
            'search',
            $request->session()->get('pencarian_terakhir', '')
        );

        $kategoriId = $request->query('kategori_id');

        // Simpan kata kunci pencarian terakhir ke session.
        if ($request->has('search')) {
            $search = trim((string) $request->query('search'));
            $request->session()->put('pencarian_terakhir', $search);
        }

        // Statistik perpustakaan menggunakan Query Builder.
        $totalJudul = DB::table('bukus')->count();

        $totalStok = DB::table('bukus')->sum('stok');

        $totalDipinjam = DB::table('peminjamans')
            ->where('status', 'dipinjam')
            ->count();

        $totalDikembalikan = DB::table('peminjamans')
            ->where('status', 'dikembalikan')
            ->count();

        // Katalog dengan eager loading, jumlah riwayat pinjam,
        // pencarian dinamis, filter kategori, dan pagination.
        $bukus = Buku::with('kategori')
            ->withCount('peminjamans')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                        ->orWhere('penulis', 'like', "%{$search}%")
                        ->orWhere('isbn', 'like', "%{$search}%");
                });
            })
            ->when($kategoriId, function ($query, $kategoriId) {
                $query->where('kategori_id', $kategoriId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('buku.index', compact(
            'bukus',
            'kategoris',
            'search',
            'kategoriId',
            'totalJudul',
            'totalStok',
            'totalDipinjam',
            'totalDikembalikan'
        ));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'isbn' => ['required', 'string', 'max:255', 'unique:bukus,isbn'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'judul' => ['required', 'string', 'min:5', 'max:255'],
            'penulis' => ['required', 'string', 'max:255'],
            'penerbit' => ['nullable', 'string', 'max:255'],
            'tahun_terbit' => [
                'nullable',
                'integer',
                'min:1900',
                'max:' . date('Y'),
            ],
            'stok' => ['required', 'integer', 'min:0'],
            'sinopsis' => ['nullable', 'string'],
        ]);

        Buku::create($data);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Buku $buku)
    {
        $buku->load('kategori');

        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('buku.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
            'isbn' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bukus', 'isbn')->ignore($buku->id),
            ],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'judul' => ['required', 'string', 'min:5', 'max:255'],
            'penulis' => ['required', 'string', 'max:255'],
            'penerbit' => ['nullable', 'string', 'max:255'],
            'tahun_terbit' => [
                'nullable',
                'integer',
                'min:1900',
                'max:' . date('Y'),
            ],
            'stok' => ['required', 'integer', 'min:0'],
            'sinopsis' => ['nullable', 'string'],
        ]);

        $buku->update($data);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}