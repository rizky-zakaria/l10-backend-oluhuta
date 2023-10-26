<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\KontenResource;
use App\Models\Konten;
use Illuminate\Http\Request;

class BiodiversityController extends Controller
{
    public function index()
    {
        $data = Konten::join('gambars', 'gambars.id', '=', 'kontens.gambar_id')
            ->where('kontens.kategori_id', 3)
            ->get(['kontens.*', 'gambars.path']);
        return new KontenResource(true, 'List data konten', $data);
    }

    public function show($id)
    {
        $konten = Konten::join('gambars', 'gambars.id', '=', 'kontens.gambar_id')
            ->where('kontens.id', $id)->first();
        if ($konten) {
            return new KontenResource(true, 'Detail Data Category!', $konten);
        }

        return new KontenResource(false, 'Detail Data Category Tidak Ditemukan!', null);
    }
}
