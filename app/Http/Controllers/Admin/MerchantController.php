<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gambar;
use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Merchant::all();
        return view('merchant.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('merchant.create');
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
            'nama'     => 'required|unique:merchants',
            'deskripsi' => 'required',
            'phone' => 'required|max:13|min:10'
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
                'jenis' => 'merchant'
            ]);
            $data = Merchant::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'gambar_id' => $gambar->id,
                'phone' => $request->phone
            ]);
            if ($data) {
                // Al('Gagal menambahkan data', 'error');
                return redirect()->route('merchant.index');
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
        $data = Merchant::find($id);
        return view('merchant.edit', compact('data'));
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
            'nama'     => 'required',
            'deskripsi' => 'required'
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
                    'jenis' => 'merchant'
                ]);

                $data = Merchant::find($id);
                $data->nama = $request->nama;
                $data->deskripsi = $request->deskripsi;
                $data->gambar_id = $gambar->id;
                $data->phone = $request->phone;
                $data->update();

                if ($data) {
                    // Al('Gagal menambahkan data', 'error');
                    return redirect()->route('merchant.index');
                } else {
                    // toast('Gagal menambahkan data', 'error');
                    return redirect()->back();
                }
            }
        } else {
            $data = Merchant::find($id);
            $data->nama = $request->nama;
            $data->deskripsi = $request->deskripsi;
            $data->phone = $request->phone;
            $data->update();

            if ($data) {
                // Al('Gagal menambahkan data', 'error');
                return redirect()->route('merchant.index');
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
        $produk = Product::where('merchant_id', $id)->get();

        if (count($produk) > 0) {
            for ($i = 0; $i < count($produk); $i++) {
                $d = Product::where('id', $produk[$i]->id)->first();
                $d->delete();
            }
        }
        $merchant = Merchant::find($id);
        $merchant->delete();
        return redirect()->back();
    }
}
