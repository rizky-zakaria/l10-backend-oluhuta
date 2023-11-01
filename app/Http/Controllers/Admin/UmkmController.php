<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gambar;
use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::where('kategori', 'umkm')
            ->orWhere('kategori', 'sewa')
            ->get();
        return view('umkm.index', compact('data'));
    }

    public function print()
    {
        $data = Product::get();
        return view('umkm.print', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Merchant::all();
        return view('umkm.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file'    => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'product'     => 'required',
            'harga' => 'required|integer',
            'stok'       => 'required|integer',
            'deskripsi'  => 'required',
            'merchant' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('file');
        $extension = $image->getClientOriginalExtension();
        $rename = 'IMG' . date('YmdHis') . '.' . $extension;
        $uploadPath = public_path('uploads');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }


        if ($image->move($uploadPath, $rename)) {
            $gambar = Gambar::create([
                'gambar' => $rename,
                'path' => 'uploads/' . $rename,
                'jenis' => 'kuliner'
            ]);
            $konten = Product::create([
                'product' => $request->product,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'gambar_id' => $gambar->id,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'ketentuan' => '-',
                'merchant_id' => $request->merchant
            ]);
            if ($konten) {
                // Al('Gagal menambahkan data', 'error');
                return redirect()->route('umkm-lokal.index');
            } else {
                // toast('Gagal menambahkan data', 'error');
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::find($id);
        $merchant = Merchant::all();
        return view('umkm.edit', compact('data', 'merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file'    => 'image|mimes:jpeg,jpg,png|max:2000',
            'product'     => 'required',
            'harga' => 'required|integer',
            'stok'       => 'required|integer',
            'deskripsi'  => 'required',
            'merchant' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->has('file')) {
            $image = $request->file('file');
            $extension = $image->getClientOriginalExtension();
            $rename = 'IMG' . date('YmdHis') . '.' . $extension;
            $uploadPath = public_path('uploads');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }


            if ($image->move($uploadPath, $rename)) {
                $gambar = Gambar::create([
                    'gambar' => $rename,
                    'path' => 'uploads/' . $rename,
                    'jenis' => 'kuliner'
                ]);
                $produk = Product::find($id);
                $produk->product = $request->product;
                $produk->harga = $request->harga;
                $produk->stok = $request->stok;
                $produk->gambar_id = $gambar->id;
                $produk->deskripsi = $request->deskripsi;
                $produk->merchant_id = $request->merchant;
                $produk->kategori = $request->kategori;
                $produk->update();
                if ($produk) {
                    // Al('Gagal menambahkan data', 'error');
                    return redirect()->route('umkm-lokal.index');
                } else {
                    // toast('Gagal menambahkan data', 'error');
                    return redirect()->back();
                }
            }
        } else {
            $produk = Product::find($id);
            $produk->product = $request->product;
            $produk->harga = $request->harga;
            $produk->stok = $request->stok;
            $produk->deskripsi = $request->deskripsi;
            $produk->merchant_id = $request->merchant;
            $produk->kategori = $request->kategori;
            $produk->update();
            if ($produk) {
                // Al('Gagal menambahkan data', 'error');
                return redirect()->route('umkm-lokal.index');
            } else {
                // toast('Gagal menambahkan data', 'error');
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        $data->delete();
        return redirect()->route('umkm-lokal.index');
    }
}
