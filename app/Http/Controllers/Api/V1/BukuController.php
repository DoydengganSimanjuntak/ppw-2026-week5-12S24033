<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BukuResource;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $sortBy = $request->input('sort_by', 'judul');
        $sortDirection = $request->input('sort_direction', 'asc');

        $allowedSorts = [
            'judul',
            'penulis',
            'tahun_terbit',
            'stok',
            'created_at',
        ];

        if (!in_array($sortBy, $allowedSorts, true)) {
            $sortBy = 'judul';
        }

        if (!in_array($sortDirection, ['asc', 'desc'], true)) {
            $sortDirection = 'asc';
        }

        $query->orderBy($sortBy, $sortDirection);

        $perPage = min(
            max((int) $request->input('per_page', 10), 1),
            50
        );

        $bukus = $query->paginate($perPage)->withQueryString();

        return BukuResource::collection($bukus);
    }

    public function show(string $id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);

        return new BukuResource($buku);
    }
}