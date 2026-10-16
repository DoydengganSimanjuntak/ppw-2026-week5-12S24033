<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Data Buku</h2>
            <p class="text-muted mb-0">
                Kelola koleksi buku perpustakaan SIPUS-Del.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('peminjaman.index') }}"
               class="btn btn-outline-primary">
                Transaksi Peminjaman
            </a>

            <a href="{{ route('buku.create') }}" class="btn btn-purple">
                + Tambah Buku
            </a>
        </div>
    </div>

    {{-- Pesan notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->has('peminjaman'))
        <div class="alert alert-danger">
            {{ $errors->first('peminjaman') }}
        </div>
    @endif

    @if ($errors->any() && !$errors->has('peminjaman'))
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Statistik perpustakaan --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Judul Buku</p>
                    <h3 class="fw-bold mb-0">{{ $totalJudul }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Stok Buku</p>
                    <h3 class="fw-bold mb-0">{{ $totalStok }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-2">Sedang Dipinjam</p>
                    <h3 class="fw-bold mb-0">{{ $totalDipinjam }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted mb-2">Sudah Dikembalikan</p>
                    <h3 class="fw-bold mb-0">{{ $totalDikembalikan }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Pencarian dan filter --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('buku.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="search" class="form-label">
                            Cari Buku
                        </label>

                        <input
                            type="text"
                            name="search"
                            id="search"
                            class="form-control"
                            placeholder="Cari judul, penulis, atau ISBN..."
                            value="{{ $search ?? '' }}"
                        >
                    </div>

                    <div class="col-md-4">
                        <label for="kategori_id" class="form-label">
                            Filter Kategori
                        </label>

                        <select name="kategori_id" id="kategori_id"
                                class="form-select">
                            <option value="">Semua Kategori</option>

                            @foreach ($kategoris as $kategori)
                                <option
                                    value="{{ $kategori->id }}"
                                    {{ (string) ($kategoriId ?? '') === (string) $kategori->id ? 'selected' : '' }}
                                >
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-purple w-100">
                            Cari
                        </button>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('buku.index') }}"
                       class="btn btn-sm btn-outline-secondary">
                        Reset Filter
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel katalog buku --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>ISBN</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th>Riwayat Pinjam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($bukus as $buku)
                            <tr>
                                <td>
                                    {{ $bukus->firstItem() + $loop->index }}
                                </td>

                                <td>{{ $buku->isbn }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>
                                    {{ $buku->kategori->nama_kategori ?? '-' }}
                                </td>
                                <td>{{ $buku->tahun_terbit ?? '-' }}</td>

                                <td>
                                    @if ($buku->stok > 0)
                                        <span class="badge bg-success">
                                            {{ $buku->stok }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Habis
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $buku->peminjamans_count }}</td>

                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a href="{{ route('buku.show', $buku) }}"
                                           class="btn btn-sm btn-info text-white">
                                            Detail
                                        </a>

                                        <a href="{{ route('buku.edit', $buku) }}"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        {{-- Tombol tetap aktif walaupun stok 0 --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalPinjam{{ $buku->id }}"
                                        >
                                            Pinjam
                                        </button>

                                        <form
                                            action="{{ route('buku.destroy', $buku) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    Tidak ada data buku yang cocok.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $bukus->links('pagination::bootstrap-5') }}
        </div>
    </div>

    {{-- Modal formulir peminjaman --}}
    @foreach ($bukus as $buku)
        <div
            class="modal fade"
            id="modalPinjam{{ $buku->id }}"
            tabindex="-1"
            aria-labelledby="labelPinjam{{ $buku->id }}"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <form
                        action="{{ route('buku.pinjam', $buku->id) }}"
                        method="POST"
                    >
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title"
                                id="labelPinjam{{ $buku->id }}">
                                Formulir Peminjaman
                            </h5>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Tutup"
                            ></button>
                        </div>

                        <div class="modal-body">
                            <p>
                                <strong>Judul buku:</strong>
                                {{ $buku->judul }}
                            </p>

                            <p>
                                <strong>Stok tersedia:</strong>
                                {{ $buku->stok }}
                            </p>

                            @if ($buku->stok <= 0)
                                <div class="alert alert-warning">
                                    Stok buku habis. Peminjaman tidak dapat
                                    diproses.
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="nim{{ $buku->id }}"
                                       class="form-label">
                                    NIM Peminjam
                                </label>

                                <input
                                    type="text"
                                    name="nim_peminjam"
                                    id="nim{{ $buku->id }}"
                                    class="form-control"
                                    maxlength="30"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="nama{{ $buku->id }}"
                                       class="form-label">
                                    Nama Peminjam
                                </label>

                                <input
                                    type="text"
                                    name="nama_peminjam"
                                    id="nama{{ $buku->id }}"
                                    class="form-control"
                                    maxlength="255"
                                    required
                                >
                            </div>

                            <small class="text-muted">
                                Lama peminjaman adalah 7 hari.
                            </small>
                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Batal
                            </button>

                            <button type="submit" class="btn btn-success">
                                Konfirmasi Pinjam
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</x-layout>