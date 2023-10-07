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
        $filter = $request->tahun . '-' . $request->bulan;
        $data = Transaksi::where('created_at', 'like', '%' . $filter . '%')->get();
        return view('laporan-transaksi.cetak', compact('data'));
    }
}
