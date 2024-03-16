<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::orderBy('created_at', 'desc')->get();
        return view('transaksi.index', compact('data'));
    }

    public function selesai($id)
    {
        $data = Transaksi::find($id);
        $data->status = 'done';
        $product = Product::find($data->product_id);
        $product->stok = $product->stok + $data->qty;
        $product->update();
        $data->update();
        return redirect(url('admin/transaksi'));
    }

    public function batal($id)
    {
        $data = Transaksi::find($id);
        $data->status = 'cancel';
        $product = Product::find($data->product_id);
        $product->stok = $product->stok + $data->qty;
        $product->update();
        $data->update();
        return redirect(url('admin/transaksi'));
    }
}
