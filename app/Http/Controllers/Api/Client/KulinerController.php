<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\MerchantResource;
use App\Models\Product;
use Illuminate\Http\Request;

class KulinerController extends Controller
{
    public function index()
    {
        $data = Product::join('gambars', 'gambars.id', '=', 'products.gambar_id')
            ->join('merchants', 'merchants.id', '=', 'products.merchant_id')
            ->where('products.kategori', 'makanan')
            ->get(['products.*', 'gambars.path', 'merchants.phone']);

        return new MerchantResource(true, 'List data konten', $data);
    }
}
