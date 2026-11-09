<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BukuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'isbn' => $this->isbn,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'stok' => $this->stok,
            'sinopsis' => $this->sinopsis,

            'kategori' => [
                'id' => $this->kategori?->id,
                'nama_kategori' => $this->kategori?->nama_kategori,
                'kode_kategori' => $this->kategori?->kode_kategori,
            ],

            '_links' => [
                'self' => url('/api/v1/bukus/' . $this->id),
                'collection' => url('/api/v1/bukus'),
            ],
        ];
    }
}