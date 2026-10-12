<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [
                'kode_kategori' => 'KAT-001',
                'nama_kategori' => 'Teknologi',
                'deskripsi' => 'Buku tentang teknologi dan komputer',
            ],
            [
                'kode_kategori' => 'KAT-002',
                'nama_kategori' => 'Pemrograman',
                'deskripsi' => 'Buku tentang bahasa dan teknik pemrograman',
            ],
            [
                'kode_kategori' => 'KAT-003',
                'nama_kategori' => 'Bisnis',
                'deskripsi' => 'Buku tentang bisnis dan kewirausahaan',
            ],
            [
                'kode_kategori' => 'KAT-004',
                'nama_kategori' => 'Sains',
                'deskripsi' => 'Buku tentang ilmu pengetahuan',
            ],
            [
                'kode_kategori' => 'KAT-005',
                'nama_kategori' => 'Novel',
                'deskripsi' => 'Buku fiksi dan cerita',
            ],
        ];

        foreach ($kategori as $data) {
            Kategori::updateOrCreate(
                ['nama_kategori' => $data['nama_kategori']],
                $data
            );
        }
    }
}