# SIPUS-Del — Sistem Informasi Perpustakaan

SIPUS-Del adalah aplikasi berbasis web menggunakan Laravel untuk mengelola koleksi buku, kategori, serta transaksi peminjaman dan pengembalian buku di perpustakaan.

## Fitur

### Pengelolaan Buku dan Kategori
- Menampilkan daftar buku dengan pagination.
- Menambah, melihat detail, mengubah, dan menghapus data buku.
- Mengelola kategori buku.
- Menghubungkan buku dan kategori menggunakan relasi database.
- Memvalidasi ISBN agar tidak duplikat.
- Memvalidasi judul dan stok buku.

### Peminjaman dan Pengembalian
- Mencatat transaksi peminjaman dengan kode pinjam.
- Mencatat NIM dan nama peminjam.
- Menetapkan tanggal pinjam dan tanggal jatuh tempo.
- Menolak peminjaman jika stok buku habis.
- Mencegah peminjam meminjam buku yang sama lagi sebelum mengembalikannya.
- Mengurangi stok saat peminjaman berhasil.
- Menambah stok saat buku dikembalikan.
- Menyimpan status dan tanggal pengembalian.
- Menggunakan transaksi database dan `lockForUpdate()` untuk membantu menjaga konsistensi data.
- Mencatat kesalahan database melalui logging.

### Pencarian dan Statistik
- Mencari buku berdasarkan judul, penulis, atau ISBN.
- Memfilter buku berdasarkan kategori.
- Mempertahankan parameter pencarian saat berpindah halaman.
- Menampilkan statistik jumlah judul, total stok, peminjaman aktif, dan buku yang sudah dikembalikan.

### Autentikasi dan Session
- Login dan logout pustakawan.
- Melindungi halaman dan operasi pengelolaan melalui autentikasi.
- Memperbarui session setelah login dan menginvalidasi session saat logout.
- Menyimpan informasi pencarian dan peminjam terakhir di session.
- Menggunakan cookie `sipus_last_login` dengan atribut HttpOnly.

## Teknologi

- Laravel
- PHP
- SQLite
- Blade Template
- Bootstrap 5.3.3

## Struktur Database

### Tabel `kategoris`
Menyimpan data kategori buku.

### Tabel `bukus`
Menyimpan data buku, termasuk ISBN, judul, penulis, penerbit, tahun terbit, kategori, stok, dan sinopsis.

### Tabel `peminjamans`
Menyimpan transaksi peminjaman, termasuk kode pinjam, buku, NIM, nama peminjam, tanggal pinjam, tanggal jatuh tempo, tanggal kembali, dan status transaksi.

Relasi utama:
- Satu kategori dapat memiliki banyak buku.
- Satu buku dapat memiliki banyak riwayat peminjaman.
- Setiap transaksi peminjaman terhubung ke satu buku.

## Persyaratan

Pastikan perangkat sudah memiliki:
- PHP yang sesuai dengan versi Laravel proyek.
- Composer.
- Git.

## Cara Instalasi

1. Clone repository:

   ```bash
   git clone https://github.com/DoydengganSimanjuntak/ppw-2026-week5-12S24033.git
   ```

2. Masuk ke folder proyek:

   ```bash
   cd ppw-2026-week5-12S24033
   ```

3. Instal dependensi:

   ```bash
   composer install
   ```

4. Buat file `.env` dari contoh:

   ```bash
   cp .env.example .env
   ```

   Pada Windows Command Prompt, gunakan:

   ```cmd
   copy .env.example .env
   ```

5. Buat application key:

   ```bash
   php artisan key:generate
   ```

6. Buat file database SQLite `database/database.sqlite` jika belum tersedia.

7. Atur koneksi database di `.env`:

   ```env
   DB_CONNECTION=sqlite
   ```

8. Jalankan migrasi dan seeder:

   ```bash
   php artisan migrate --seed
   ```

9. Jalankan aplikasi:

   ```bash
   php artisan serve
   ```

10. Buka aplikasi melalui:

    http://127.0.0.1:8000

## Akun Pustakawan untuk Pengujian

Seeder pustakawan menyediakan akun pengujian berikut:

- **Email:** `pustakawan@del.ac.id`
- **Password:** `password123`

Gunakan akun ini hanya untuk lingkungan praktikum lokal. Jangan gunakan password tersebut untuk akun nyata.

## Pengujian yang Dilakukan

- Login dan logout pustakawan.
- Peminjaman buku ketika stok tersedia.
- Penolakan peminjaman ketika stok habis.
- Pengurangan stok saat peminjaman berhasil.
- Pengembalian buku, pembaruan status, dan penambahan stok.
- Pencarian dan filter katalog buku.
- Pemeriksaan cookie `sipus_last_login` dengan atribut HttpOnly melalui Developer Tools browser.

## Bukti Pengujian

Tambahkan screenshot hasil pengujian ke folder `docs/screenshots/`, kemudian cantumkan di bagian ini.

Screenshot yang disarankan:
- `login.png` — halaman login pustakawan.
- `peminjaman-berhasil.png` — peminjaman berhasil.
- `stok-habis.png` — penolakan ketika stok buku habis.
- `pengembalian.png` — transaksi pengembalian berhasil.
- `cookie-httponly.png` — atribut HttpOnly pada cookie.

Nama dan lokasi screenshot harus sesuai dengan file yang benar-benar kamu simpan.

## Pengembang

**Nama:** Doy Denggan Simanjuntak  
**Program Studi:** Sistem Informasi  
**Institusi:** Institut Teknologi Del  
**Mata Kuliah:** Pemrograman dan Pengujian Aplikasi Web