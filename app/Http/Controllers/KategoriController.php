<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('buku')
            ->latest()
            ->paginate(10);

        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_kategori' => [
                'required',
                'string',
                'max:50',
                'unique:kategoris,kode_kategori',
            ],
            'nama_kategori' => [
                'required',
                'string',
                'max:255',
                'unique:kategoris,nama_kategori',
            ],
            'deskripsi' => ['nullable', 'string'],
        ]);

        Kategori::create($data);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Kategori $kategori)
    {
        $kategori->loadCount('buku');

        return view('kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'kode_kategori' => [
                'required',
                'string',
                'max:50',
                Rule::unique('kategoris', 'kode_kategori')
                    ->ignore($kategori->id),
            ],
            'nama_kategori' => [
                'required',
                'string',
                'max:255',
                Rule::unique('kategoris', 'nama_kategori')
                    ->ignore($kategori->id),
            ],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $kategori->update($data);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}