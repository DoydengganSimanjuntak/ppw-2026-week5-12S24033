<x-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Transaksi Peminjaman</h2>
            <p class="text-muted mb-0">
                Daftar peminjaman dan pengembalian buku SIPUS-Del.
            </p>
        </div>

        <a href="{{ route('buku.index') }}" class="btn btn-purple">
            Kembali ke Katalog
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Kode Pinjam</th>
                            <th>Judul Buku</th>
                            <th>NIM</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($peminjamans as $peminjaman)
                            <tr>
                                <td>
                                    {{ $peminjamans->firstItem() + $loop->index }}
                                </td>
                                <td>{{ $peminjaman->kode_pinjam }}</td>
                                <td>
                                    {{ $peminjaman->buku->judul ?? 'Buku tidak tersedia' }}
                                </td>
                                <td>{{ $peminjaman->nim_peminjam }}</td>
                                <td>{{ $peminjaman->nama_peminjam }}</td>
                                <td>
                                    {{ $peminjaman->tanggal_pinjam->format('d-m-Y') }}
                                </td>
                                <td>
                                    {{ $peminjaman->tanggal_jatuh_tempo->format('d-m-Y') }}
                                </td>
                                <td>
                                    @if ($peminjaman->status === 'dipinjam')
                                        <span class="badge bg-warning text-dark">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($peminjaman->status === 'dipinjam')
                                        <form
                                            action="{{ route('peminjaman.kembali', $peminjaman->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Proses pengembalian buku ini?')">
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-sm btn-success">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    Belum ada transaksi peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $peminjamans->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-layout>