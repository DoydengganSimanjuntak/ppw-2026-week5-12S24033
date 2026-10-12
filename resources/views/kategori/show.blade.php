@extends('layouts.app')

@section('title', 'Detail Kategori - SIPUS-Del')

@section('content')
<h2 class="fw-bold mb-4">Detail Kategori</h2>

<div class="card">
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Nama Kategori</th>
                <td>{{ $kategori->nama_kategori }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $kategori->deskripsi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jumlah Buku</th>
                <td>{{ $kategori->buku()->count() }}</td>
            </tr>
        </table>

        <a href="{{ route('kategori.edit', $kategori) }}"
           class="btn btn-warning">Edit</a>

        <a href="{{ route('kategori.index') }}"
           class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection