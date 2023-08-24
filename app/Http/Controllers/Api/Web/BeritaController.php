<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\BeritaResource;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::join('gambars', 'gambars.id', '=', 'beritas.gambar_id')
            ->when(request()->q, function ($data) {
                $data = $data->where('judul', 'like', '%' . request()->q . '%');
            })->latest()->paginate(6);

        return new BeritaResource(true, 'List Data Categories', $data);
    }
}
