@extends('layouts.app')

@section('title', 'Detail Buku - SIPUS-Del')

@section('content')
<h2 class="fw-bold mb-4">Detail Buku</h2>

<div class="card">
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Judul Buku</th>
                <td>{{ $buku->judul }}</td>
            </tr>
            <tr>
                <th>Penulis</th>
                <td>{{ $buku->penulis }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $buku->kategori->nama_kategori }}</td>
            </tr>
            <tr>
                <th>Penerbit</th>
                <td>{{ $buku->penerbit ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tahun Terbit</th>
                <td>{{ $buku->tahun_terbit ?? '-' }}</td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>{{ $buku->stok }}</td>
            </tr>
        </table>

        <a href="{{ route('buku.edit', $buku) }}" class="btn btn-warning">
            Edit
        </a>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>
@endsection