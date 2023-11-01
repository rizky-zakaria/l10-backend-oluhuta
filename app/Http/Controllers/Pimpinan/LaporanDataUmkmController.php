<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class LaporanDataUmkmController extends Controller
{
    public function index()
    {
        $data = Product::where('kategori', 'umkm')
            ->orWhere('kategori', 'sewa')
            ->get();
        return view('umkm.index', compact('data'));
    }

    public function print()
    {
        $data = Product::where('kategori', 'umkm')
            ->orWhere('kategori', 'sewa')
            ->get();
        return view('umkm.print', compact('data'));
    }
}
