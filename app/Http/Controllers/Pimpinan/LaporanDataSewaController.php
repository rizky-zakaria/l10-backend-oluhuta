<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanDataSewaController extends Controller
{
    public function index()
    {
        $data = Transaksi::orderBy('created_at', 'desc')->get();
        return view('transaksi.index', compact('data'));
    }

    public function print()
    {
        $data = Transaksi::orderBy('created_at', 'desc')->get();
        return view('transaksi.print', compact('data'));
    }
}
