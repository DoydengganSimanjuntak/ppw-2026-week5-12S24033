<?php

namespace Database\Factories;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Buku>
 */
class BukuFactory extends Factory
{
    protected $model = Buku::class;

    public function definition(): array
    {
        return [
            'isbn' => fake()->unique()->numerify('978##########'),
            'kategori_id' => Kategori::query()->inRandomOrder()->value('id')
                ?? Kategori::factory(),
            'judul' => fake()->sentence(4),
            'penulis' => fake()->name(),
            'penerbit' => fake()->company(),
            'tahun_terbit' => fake()->numberBetween(2000, 2026),
            'stok' => fake()->numberBetween(0, 100),
            'sinopsis' => fake()->paragraph(),
        ];
    }
}