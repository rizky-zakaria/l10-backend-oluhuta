<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\BeritaResource;
use App\Http\Resources\KontenResource;
use App\Models\Konten;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Konten::join('gambars', 'gambars.id', '=', 'kontens.gambar_id')
            ->where('kontens.kategori_id', 2)
            ->get();
        return new BeritaResource(true, 'List data konten', $data);
    }

    public function show($id)
    {
        $konten = Konten::join('gambars', 'gambars.id', '=', 'kontens.gambar_id')
            ->where('kontens.id', $id)->first();
        if ($konten) {
            return new BeritaResource(true, 'Detail Data Category!', $konten);
        }

        return new BeritaResource(false, 'Detail Data Category Tidak Ditemukan!', null);
    }
}
