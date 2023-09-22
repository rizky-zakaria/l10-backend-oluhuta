<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\KontenResource;
use App\Models\Konten;
use Illuminate\Http\Request;

class CulturdiversityController extends Controller
{
    public function index()
    {
        $data = Konten::join('gambars', 'gambars.id', '=', 'kontens.gambar_id')
            ->where('kontens.kategori_id', 2)
            ->when(request()->q, function ($data) {
                $data = $data->where('kontens.judul', 'like', '%' . request()->q . '%');
            })->latest()->paginate(6);
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
