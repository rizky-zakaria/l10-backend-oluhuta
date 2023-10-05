@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Merchant</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('merchant.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="col-12">
                        <label for="merchant">Nama Merchant</label>
                        <input type="text" name="nama" id="merchant" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="gambar">Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar"
                                aria-describedby="inputGroupFileAddon01" name="file">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
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
@stop
