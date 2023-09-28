<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\MerchantResource;
use App\Models\MerchantKuliner;
use Illuminate\Http\Request;

class MerchantKulinerController extends Controller
{
    public function index()
    {
        $data = MerchantKuliner::join('gambars', 'gambars.id', '=', 'merchant_kuliners.gambar_id')
            ->get();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil mendapatkan data',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $konten = MerchantKuliner::join('gambars', 'gambars.id', '=', 'merchant_kuliners.gambar_id')
            ->where('merchant_kuliners.id', $id)->first();
        if ($konten) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil mendapatkan data',
                'data' => $konten
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mendapatkan data',
            'data' => null
        ]);
    }
}
