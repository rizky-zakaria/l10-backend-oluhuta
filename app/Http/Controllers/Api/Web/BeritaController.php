<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\BeritaResource;
use App\Models\Berita;
use App\Models\Konten;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Konten::select(['kontens.*', 'gambars.path', 'gambars.jenis'])
            ->join('gambars', 'gambars.id', '=', 'kontens.gambar_id')
            ->where('kontens.kategori_id', 4)
            // ->get(['kontens.*', 'gambars.path', 'gambars.jenis'])
            ->latest()
            ->paginate(3);

        return new BeritaResource(true, 'List Data Berita', $data);
    }
}
