<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\MerchantResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::join('gambars', 'gambars.id', '=', 'products.gambar_id')
            ->get(['products.*', 'gambars.path']);

        return new MerchantResource(true, 'List data konten', $data);
    }
}
