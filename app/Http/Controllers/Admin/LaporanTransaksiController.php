<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanTransaksiController extends Controller
{
    public function index()
    {
        return view('laporan-transaksi.index');
    }

    public function show()
    {
        return view('laporan-transaksi.show');
    }
}
