@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Kategori</h2>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kode_kategori" class="form-label">Kode Kategori</label>
            <input
                type="text"
                name="kode_kategori"
                id="kode_kategori"
                class="form-control @error('kode_kategori') is-invalid @enderror"
                value="{{ old('kode_kategori', $kategori->kode_kategori) }}"
                required
            >
            @error('kode_kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input
                type="text"
                name="nama_kategori"
                id="nama_kategori"
                class="form-control @error('nama_kategori') is-invalid @enderror"
                value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                required
            >
            @error('nama_kategori')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea
                name="deskripsi"
                id="deskripsi"
                class="form-control"
                rows="4"
            >{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection