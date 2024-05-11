<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanDataSewaController extends Controller
{
    public function index()
    {
        $data = Transaksi::join('products', 'products.id', '=', 'transaksis.product_id')
            // ->where('products.kategori', '!=', 'sewa')
            ->orderBy('transaksis.created_at', 'desc')
            ->get(['transaksis.*', 'products.product', 'products.kategori']);
        return view('transaksi.index', compact('data'));
    }

    public function print()
    {
        $data = Transaksi::orderBy('created_at', 'desc')->get();
        return view('transaksi.print', compact('data'));
    }
}
