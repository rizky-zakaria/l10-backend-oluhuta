<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class LaporanDataKunjunganController extends Controller
{
    public function index()
    {
        return view('laporan-kunjungan.index');
    }

    public function print(Request $request)
    {
        $filter = $request->tahun . '-' . $request->bulan;
        $data = Kunjungan::where('created_at', 'like', '%' . $filter . '%')->get();
        return view('laporan-kunjungan.cetak', compact('data'));
    }
}
