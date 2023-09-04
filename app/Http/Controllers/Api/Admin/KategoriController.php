<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function __invoke(Request $request)
    {
        $data = Kategori::all();

        return new KategoriResource(true, 'List data kategori', $data);
    }
}
