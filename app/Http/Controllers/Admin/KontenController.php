<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Str;
use App\Models\Gambar;
use App\Models\Kategori;
use App\Models\Konten;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Konten::orderBy('tgl_post', 'desc')->get();
        return view('konten.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Kategori::all();
        return view('konten.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'file'    => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'judul'     => 'required|unique:kontens',
            'sub_judul' => 'required',
            'isi'       => 'required',
            'kategori'  => 'required'
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
                'jenis' => 'konten'
            ]);
            $konten = Konten::create([
                'judul' => $request->judul,
                'sub_judul' => $request->sub_judul,
                'slug' => Str::slug($request->judul, '-'),
                'gambar_id' => $gambar->id,
                'isi' => $request->isi,
                'kategori_id' => $request->kategori,
                'tgl_post' => date('Y-m-d')
            ]);
            if ($konten) {
                // Al('Gagal menambahkan data', 'error');
                return redirect()->route('konten.index');
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
        $kategori = Kategori::all();
        $data = Konten::find($id);
        return view('konten.edit', compact('data', 'kategori'));
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
            // 'file'    => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'judul'     => 'required|unique:kontens',
            'sub_judul' => 'required',
            'isi'       => 'required',
            'kategori'  => 'required'
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
                    'jenis' => 'konten'
                ]);
                $konten = Konten::find($id);
                $konten->update([
                    'judul' => $request->judul,
                    'sub_judul' => $request->sub_judul,
                    'slug' => Str::slug($request->judul, '-'),
                    'gambar_id' => $gambar->id,
                    'isi' => $request->isi,
                    'kategori_id' => $request->kategori,
                    'tgl_post' => date('Y-m-d')
                ]);
                if ($konten) {
                    // Al('Gagal menambahkan data', 'error');
                    return redirect()->route('konten.index');
                } else {
                    // toast('Gagal menambahkan data', 'error');
                    return redirect()->back();
                }
            }
        } else {
            $konten = Konten::find($id);
            $konten->update([
                'judul' => $request->judul,
                'sub_judul' => $request->sub_judul,
                'slug' => Str::slug($request->judul, '-'),
                'isi' => $request->isi,
                'kategori_id' => $request->kategori,
                'tgl_post' => date('Y-m-d')
            ]);
            if ($konten) {
                // Al('Gagal menambahkan data', 'error');
                return redirect()->route('konten.index');
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
        $data = Konten::find($id);
        $data->delete();
        return redirect()->route('konten.index');
    }
}
