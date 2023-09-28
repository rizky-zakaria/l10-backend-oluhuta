<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\MerchantResource;
use App\Models\MerchantEkonomiKreatif;
use Illuminate\Http\Request;

class MerchantEkonomiKreatifController extends Controller
{
    public function index()
    {
        $data = MerchantEkonomiKreatif::join('gambars', 'gambars.id', '=', 'merchant_ekonomi_kreatifs.gambar_id')
            ->get();
        return new MerchantResource(true, 'List data konten', $data);
    }

    public function show($id)
    {
        $konten = MerchantEkonomiKreatif::join('gambars', 'gambars.id', '=', 'merchant_ekonomi_kreatifs.gambar_id')
            ->where('merchant_ekonomi_kreatifs.id', $id)->first();
        if ($konten) {
            return new MerchantResource(true, 'Detail Data Category!', $konten);
        }

        return new MerchantResource(false, 'Detail Data Category Tidak Ditemukan!', null);
    }
}
