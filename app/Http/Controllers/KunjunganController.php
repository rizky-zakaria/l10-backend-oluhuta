<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\User;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function show($id)
    {
        $data = User::find($id);
        if (isset($data)) {
            Kunjungan::create([
                'user_id' => $id
            ]);
            $status = 'Berhasil..';
            return view('kunjungan.show', compact('status'));
        } else {
            $status = 'Gagal..';
            return view('kunjungan.show', compact('status'));
        }
    }

    public function qrcode()
    {
        return view('kunjungan.qrcode');
    }
}
