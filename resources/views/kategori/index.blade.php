@extends('layouts.app')

@section('title', 'Data Kategori - SIPUS-Del')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Data Kategori</h2>
        <p class="text-muted">Kelola kategori koleksi buku.</p>
    </div>

    <a href="{{ route('kategori.create') }}" class="btn btn-purple">
        + Tambah Kategori
    </a>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kategoris as $kategori)
                <tr>
                    <td>{{ $kategoris->firstItem() + $loop->index }}</td>
                    <td>{{ $kategori->nama_kategori }}</td>
                    <td>{{ $kategori->deskripsi ?? '-' }}</td>
                    <td>
                        <a href="{{ route('kategori.show', $kategori) }}"
                           class="btn btn-sm btn-info text-white">Detail</a>

                        <a href="{{ route('kategori.edit', $kategori) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('kategori.destroy', $kategori) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">
                        Belum ada data kategori.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $kategoris->links() }}
    </div>
</div>
@endsection