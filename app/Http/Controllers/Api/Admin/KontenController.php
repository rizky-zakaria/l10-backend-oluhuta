<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\KontenResource;
use App\Models\Gambar;
use App\Models\Konten;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KontenController extends Controller
{

    public function index()
    {
        $data = Konten::join('gambars', 'gambars.id', '=', 'kontens.gambar_id')
            ->when(request()->q, function ($data) {
                $data = $data->where('kontens.judul', 'like', '%' . request()->q . '%');
            })->latest()->paginate(6);
        return new KontenResource(true, 'List data konten', $data);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'judul'     => 'required|unique:kontens',
            'sub_judul' => 'required',
            'isi'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('gambar');
        $image->storeAs('public/konten', $image->hashName());

        $gambar = Gambar::create([
            'gambar' => $image->hashName(),
            'path' => 'public/konten/' . $image->hashName(),
            'jenis' => 'konten'
        ]);

        $konten = Konten::create([
            'judul' => $request->judul,
            'sub_judul' => $request->sub_judul,
            'slug' => Str::slug($request->judul, '-'),
            'gambar_id' => $gambar->id,
            'isi' => $request->isi,
            'tgl_post' => date('Y-m-d')
        ]);

        if ($konten) {
            return new KontenResource(true, 'Data Category Berhasil Disimpan!', $konten);
        }

        return new KontenResource(false, 'Data Category Gagal Disimpan!', null);
    }

    public function show($id)
    {
        $konten = Konten::whereId($id)->first();
        if ($konten) {
            return new KontenResource(true, 'Detail Data Category!', $konten);
        }

        return new KontenResource(false, 'Detail Data Category Tidak Ditemukan!', null);
    }

    public function update(Request $request, Konten $konten)
    {
        $validator = Validator::make($request->all(), [
            'judul'     => 'required|unique:judul,' . $konten->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->file('gambar')) {
            $gambar = Gambar::find($konten->gambar_id);
            Storage::disk('local')->delete('public/konten/' . basename($gambar->gambar));

            $image = $request->file('gambar');
            $image->storeAs('public/konten', $image->hashName());

            $gambar->update([
                'gambar' => $image->hashName(),
                'path' => 'public/konten/' . $image->hashName(),
                'jenis' => 'konten'
            ]);

            $konten->update([
                'judul' => $image->hashName(),
                'sub_judul' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'isi' => $request->isi
            ]);
        }

        $konten->update([
            'judul' => $image->hashName(),
            'sub_judul' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'isi' => $request->isi
        ]);

        if ($konten) {
            return new KontenResource(true, 'Data Category Berhasil Diupdate!', $konten);
        }

        return new KontenResource(false, 'Data Category Gagal Diupdate!', null);
    }

    public function destroy(Konten $konten)
    {
        $gambar = Gambar::find($konten->gambar_id);
        Storage::disk('local')->delete('public/categories/' . basename($gambar->gambar));

        if ($konten->delete()) {
            return new KontenResource(true, 'Data Category Berhasil Dihapus!', null);
        }

        return new KontenResource(false, 'Data Category Gagal Dihapus!', null);
    }
}
