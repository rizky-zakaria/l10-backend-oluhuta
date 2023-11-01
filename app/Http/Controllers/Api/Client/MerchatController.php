<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\MerchantResource;
use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;

class MerchatController extends Controller
{
    public function index()
    {
        $data = Merchant::join('gambars', 'gambars.id', '=', 'merchants.gambar_id')
            ->where('merchants.jenis', 'umkm')
            ->get(['merchants.*', 'gambars.path']);
        return new MerchantResource(true, 'List data konten', $data);
    }

    public function show($id)
    {
        $konten = Product::join('gambars', 'gambars.id', '=', 'products.gambar_id')
            ->where('products.kategori', 'umkm')
            ->orWhere('products.kategori', 'sewa')
            ->where('products.merchant_id', $id)->get(['products.*', 'gambars.path']);
        if ($konten) {
            return new MerchantResource(true, 'Detail Data Category!', $konten);
        }

        return new MerchantResource(false, 'Detail Data Category Tidak Ditemukan!', null);
    }

    public function product($id)
    {
        $konten = Product::join('gambars', 'gambars.id', '=', 'products.gambar_id')
            ->where('products.id', $id)->first(['products.*', 'gambars.path']);
        if ($konten) {
            return new MerchantResource(true, 'Detail Data Category!', $konten);
        }

        return new MerchantResource(false, 'Detail Data Category Tidak Ditemukan!', null);
    }
}
