<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->latest()->paginate(10);

        return view('buku.index', compact('bukus'));
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
            'tahun_terbit' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
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
            'tahun_terbit' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
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