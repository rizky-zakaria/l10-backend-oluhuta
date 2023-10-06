<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class LaporanKunjunganController extends Controller
{
    public function index()
    {
        return view('laporan-kunjungan.index');
    }

    public function cetak(Request $request)
    {
        $filter = $request->tahun . '-' . $request->bulan;
        $data = Kunjungan::where('created_at', 'like', '%' . $filter . '%')->get();
        // dd($filter);
        return view('laporan-kunjungan.cetak', compact('data'));
    }
}
