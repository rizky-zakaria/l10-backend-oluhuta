<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Konten;
use Illuminate\Http\Request;

class LaporanDataWisataController extends Controller
{
    public function index()
    {
        $data = Konten::where('kategori_id', '!=', 4)->orderBy('tgl_post', 'desc')->get();
        return view('konten.index', compact('data'));
    }

    public function print()
    {
        $data = Konten::where('kategori_id', '!=', 4)->orderBy('tgl_post', 'desc')->get();
        return view('konten.print', compact('data'));
    }
}
