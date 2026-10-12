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
                'nama_kategori' => 'Teknologi',
                'deskripsi' => 'Buku tentang teknologi dan komputer',
            ],
            [
                'nama_kategori' => 'Pemrograman',
                'deskripsi' => 'Buku tentang bahasa dan teknik pemrograman',
            ],
            [
                'nama_kategori' => 'Bisnis',
                'deskripsi' => 'Buku tentang bisnis dan kewirausahaan',
            ],
            [
                'nama_kategori' => 'Sains',
                'deskripsi' => 'Buku tentang ilmu pengetahuan',
            ],
            [
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