<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index($kategori)
    {
        // dd($kategori);
        if ($kategori == 'penyewaan') {
            $data = Transaksi::join('products', 'products.id', '=', 'transaksis.product_id')
                ->where('products.kategori', 'sewa')
                ->orderBy('transaksis.created_at', 'desc')
                ->get();
        } else {
            $data = Transaksi::join('products', 'products.id', '=', 'transaksis.product_id')
                ->where('products.kategori', '!=', 'sewa')
                ->orderBy('transaksis.created_at', 'desc')
                ->get();
        }
        return view('transaksi.index', compact('data', 'kategori'));
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
