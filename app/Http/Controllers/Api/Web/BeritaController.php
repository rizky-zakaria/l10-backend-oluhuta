<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::join('gambars', 'gambars.id', '=', 'beritas.gambar_id')->get();
        if ($data) {
        } else {
        }
    }
}
