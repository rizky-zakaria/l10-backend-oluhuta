@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Kuliner</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('merchant.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="col-12">
                        <label for="product">Produk</label>
                        <input type="text" name="product" id="product" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="stok">Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="merchant">Merchant</label>
                        <select name="merchant" class="form-control" id="merchant">
                            @foreach ($data as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="gambar">Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar"
                                aria-describedby="inputGroupFileAddon01" name="file">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="my-editor form-control" id="my-editor" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <a href="{{ route('merchant.index') }}" class="btn btn-sm btn-light">Kembali</a>
                <button type="submit" class="btn btn-sm  float-right btn-success"><i class="fas fa-save"></i>
                    Simpan</button>
            </div>
        </form>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('js')
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('my-editor');
    </script>
@stop
