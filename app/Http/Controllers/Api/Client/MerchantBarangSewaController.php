<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\MerchantResource;
use App\Models\MerchantBarangSewa;
use Illuminate\Http\Request;

class MerchantBarangSewaController extends Controller
{
    public function index()
    {
        $data = MerchantBarangSewa::join('gambars', 'gambars.id', '=', 'merchant_barang_sewas.gambar_id')
            ->get();
        return new MerchantResource(true, 'List data konten', $data);
    }

    public function show($id)
    {
        $konten = MerchantBarangSewa::join('gambars', 'gambars.id', '=', 'merchant_barang_sewas.gambar_id')
            ->where('merchant_barang_sewas.id', $id)->first();
        if ($konten) {
            return new MerchantResource(true, 'Detail Data Category!', $konten);
        }

        return new MerchantResource(false, 'Detail Data Category Tidak Ditemukan!', null);
    }
}
