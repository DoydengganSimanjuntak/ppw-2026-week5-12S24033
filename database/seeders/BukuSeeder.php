<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $buku = [
            ['isbn' => '9780000000001', 'kategori_id' => 1, 'judul' => 'Teknologi Informasi', 'penulis' => 'Abdul Kadir', 'penerbit' => 'Andi', 'tahun_terbit' => 2022, 'stok' => 10, 'sinopsis' => 'Pengenalan teknologi informasi dan penerapannya.'],
            ['isbn' => '9780000000002', 'kategori_id' => 1, 'judul' => 'Dasar Sistem Informasi', 'penulis' => 'Tata Sutabri', 'penerbit' => 'Andi', 'tahun_terbit' => 2021, 'stok' => 8, 'sinopsis' => 'Dasar sistem informasi dalam organisasi.'],
            ['isbn' => '9780000000003', 'kategori_id' => 1, 'judul' => 'Jaringan Komputer', 'penulis' => 'Budi Raharjo', 'penerbit' => 'Informatika', 'tahun_terbit' => 2023, 'stok' => 6, 'sinopsis' => 'Konsep dasar jaringan komputer.'],
            ['isbn' => '9780000000004', 'kategori_id' => 1, 'judul' => 'Keamanan Informasi', 'penulis' => 'Rudy Tantra', 'penerbit' => 'Andi', 'tahun_terbit' => 2022, 'stok' => 5, 'sinopsis' => 'Pengantar keamanan informasi.'],

            ['isbn' => '9780000000005', 'kategori_id' => 2, 'judul' => 'Belajar PHP', 'penulis' => 'Budi Raharjo', 'penerbit' => 'Informatika', 'tahun_terbit' => 2022, 'stok' => 10, 'sinopsis' => 'Pengenalan pemrograman PHP.'],
            ['isbn' => '9780000000006', 'kategori_id' => 2, 'judul' => 'Pemrograman Java', 'penulis' => 'Abdul Kadir', 'penerbit' => 'Andi', 'tahun_terbit' => 2021, 'stok' => 7, 'sinopsis' => 'Dasar pemrograman menggunakan Java.'],
            ['isbn' => '9780000000007', 'kategori_id' => 2, 'judul' => 'Laravel untuk Pemula', 'penulis' => 'Jubilee Enterprise', 'penerbit' => 'Elex Media', 'tahun_terbit' => 2023, 'stok' => 9, 'sinopsis' => 'Pengenalan pengembangan aplikasi dengan Laravel.'],
            ['isbn' => '9780000000008', 'kategori_id' => 2, 'judul' => 'Algoritma dan Pemrograman', 'penulis' => 'Rinaldi Munir', 'penerbit' => 'Informatika', 'tahun_terbit' => 2020, 'stok' => 4, 'sinopsis' => 'Konsep algoritma dan dasar pemrograman.'],

            ['isbn' => '9780000000009', 'kategori_id' => 3, 'judul' => 'Pengantar Manajemen', 'penulis' => 'T. Hani Handoko', 'penerbit' => 'BPFE', 'tahun_terbit' => 2020, 'stok' => 5, 'sinopsis' => 'Dasar-dasar manajemen organisasi.'],
            ['isbn' => '9780000000010', 'kategori_id' => 3, 'judul' => 'Kewirausahaan', 'penulis' => 'Suryana', 'penerbit' => 'Salemba Empat', 'tahun_terbit' => 2021, 'stok' => 8, 'sinopsis' => 'Konsep dan praktik kewirausahaan.'],
            ['isbn' => '9780000000011', 'kategori_id' => 3, 'judul' => 'Manajemen Bisnis', 'penulis' => 'Buchari Alma', 'penerbit' => 'Alfabeta', 'tahun_terbit' => 2022, 'stok' => 6, 'sinopsis' => 'Pengantar pengelolaan bisnis.'],
            ['isbn' => '9780000000012', 'kategori_id' => 3, 'judul' => 'Pengantar Akuntansi', 'penulis' => 'Warren', 'penerbit' => 'Salemba Empat', 'tahun_terbit' => 2021, 'stok' => 7, 'sinopsis' => 'Dasar pencatatan dan laporan keuangan.'],

            ['isbn' => '9780000000013', 'kategori_id' => 4, 'judul' => 'Fisika Dasar', 'penulis' => 'Halliday', 'penerbit' => 'Erlangga', 'tahun_terbit' => 2020, 'stok' => 5, 'sinopsis' => 'Konsep dasar ilmu fisika.'],
            ['isbn' => '9780000000014', 'kategori_id' => 4, 'judul' => 'Kimia Dasar', 'penulis' => 'Raymond Chang', 'penerbit' => 'Erlangga', 'tahun_terbit' => 2021, 'stok' => 6, 'sinopsis' => 'Pengenalan konsep dasar kimia.'],
            ['isbn' => '9780000000015', 'kategori_id' => 4, 'judul' => 'Biologi Umum', 'penulis' => 'Campbell', 'penerbit' => 'Erlangga', 'tahun_terbit' => 2022, 'stok' => 4, 'sinopsis' => 'Pengantar ilmu biologi.'],
            ['isbn' => '9780000000016', 'kategori_id' => 4, 'judul' => 'Matematika Diskrit', 'penulis' => 'Rinaldi Munir', 'penerbit' => 'Informatika', 'tahun_terbit' => 2023, 'stok' => 8, 'sinopsis' => 'Konsep matematika diskrit dan penerapannya.'],

            ['isbn' => '9780000000017', 'kategori_id' => 5, 'judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'penerbit' => 'Bentang Pustaka', 'tahun_terbit' => 2005, 'stok' => 5, 'sinopsis' => 'Kisah perjuangan dan persahabatan anak-anak.'],
            ['isbn' => '9780000000018', 'kategori_id' => 5, 'judul' => 'Bumi', 'penulis' => 'Tere Liye', 'penerbit' => 'Gramedia', 'tahun_terbit' => 2014, 'stok' => 7, 'sinopsis' => 'Kisah petualangan fantasi.'],
            ['isbn' => '9780000000019', 'kategori_id' => 5, 'judul' => 'Negeri 5 Menara', 'penulis' => 'Ahmad Fuadi', 'penerbit' => 'Gramedia', 'tahun_terbit' => 2009, 'stok' => 6, 'sinopsis' => 'Kisah pendidikan dan perjuangan meraih cita-cita.'],
            ['isbn' => '9780000000020', 'kategori_id' => 5, 'judul' => 'Sang Pemimpi', 'penulis' => 'Andrea Hirata', 'penerbit' => 'Bentang Pustaka', 'tahun_terbit' => 2006, 'stok' => 4, 'sinopsis' => 'Kisah persahabatan dan impian masa depan.'],
        ];

        foreach ($buku as $data) {
            Buku::updateOrCreate(
                ['isbn' => $data['isbn']],
                $data
            );
        }
    }
}