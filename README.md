# SIPUS-Del — Sistem Informasi Perpustakaan

SIPUS-Del adalah aplikasi berbasis web yang dibuat menggunakan Laravel untuk membantu pengelolaan data buku dan kategori buku perpustakaan.

## Fitur

- Menampilkan daftar buku dengan pagination.
- Menambah, melihat detail, mengubah, dan menghapus data buku.
- Mengelola kategori buku.
- Menghubungkan buku dengan kategori menggunakan relasi database.
- Memvalidasi ISBN agar tidak duplikat.
- Memvalidasi judul minimal 5 karakter.
- Memastikan stok buku tidak bernilai negatif.
- Menampilkan notifikasi setelah operasi berhasil.

## Teknologi

- Laravel
- PHP
- SQLite
- Blade Template
- Bootstrap 5.3.3

## Struktur Data

### Tabel `kategoris`

Menyimpan data kategori buku, termasuk kode dan nama kategori.

### Tabel `bukus`

Menyimpan data buku, termasuk ISBN, judul, penulis, penerbit, tahun terbit, kategori, stok, dan sinopsis.

Relasi yang digunakan adalah one-to-many: satu kategori dapat memiliki banyak buku.

## Persyaratan

Pastikan perangkat sudah memiliki:

- PHP sesuai kebutuhan versi Laravel proyek.
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

4. Buat file konfigurasi lingkungan:

   ```bash
   cp .env.example .env
   ```

   Jika menggunakan Windows Command Prompt, bisa gunakan:

   ```cmd
   copy .env.example .env
   ```

5. Buat application key:

   ```bash
   php artisan key:generate
   ```

6. Siapkan database SQLite dengan membuat file `database/database.sqlite`, jika belum tersedia.

7. Pastikan konfigurasi `.env` menggunakan SQLite:

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

    http://127.0.0.1:8000/buku

## Pengembang

**Nama:** Doy Denggan Simanjuntak  
**Program Studi:** Sistem Informasi  
**Institusi:** Institut Teknologi Del  
**Mata Kuliah:** Pemrograman dan Pengujian Aplikasi Web