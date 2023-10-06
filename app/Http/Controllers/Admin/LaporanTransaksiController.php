<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanTransaksiController extends Controller
{
    public function index()
    {
        return view('laporan-transaksi.index');
    }

    public function cetak(Request $request)
    {
        $data = Transaksi::where('created_at', 'like', '%' . $request->tahun . '-' . $request->bulan . '%')->get();
        return view('laporan-transaksi.cetak', compact('data'));
    }
}
