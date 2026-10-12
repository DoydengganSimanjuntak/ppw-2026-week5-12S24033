@extends('layouts.app')

@section('title', 'Data Buku - SIPUS-Del')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Data Buku</h2>
            <p class="text-muted mb-0">
                Kelola koleksi buku perpustakaan SIPUS-Del.
            </p>
        </div>

        <a href="{{ route('buku.create') }}" class="btn btn-purple">
            + Tambah Buku
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bukus as $buku)
                            <tr>
                                <td>{{ $bukus->firstItem() + $loop->index }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>{{ $buku->kategori->nama_kategori }}</td>
                                <td>{{ $buku->tahun_terbit ?? '-' }}</td>
                                <td>{{ $buku->stok }}</td>
                                <td>
                                    <a href="{{ route('buku.show', $buku) }}"
                                       class="btn btn-sm btn-info text-white">Detail</a>

                                    <a href="{{ route('buku.edit', $buku) }}"
                                       class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('buku.destroy', $buku) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
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
                                <td colspan="7" class="text-center py-4">
                                    Belum ada data buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $bukus->links() }}
        </div>
    </div>
@endsection