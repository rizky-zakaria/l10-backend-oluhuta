<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index($nomor_order)
    {
        $data = Transaksi::where('order_id', $nomor_order)->first();
        return view('web.cetak_bukti_bayar', compact('data'));
    }
}
