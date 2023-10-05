@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Konten</h1>
@stop

@section('content')
    <div class="card">
        <form action="{{ route('konten.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="col-12">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="sub_judul">Sub Judul</label>
                        <input type="text" name="sub_judul" id="sub_judul" class="form-control">
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
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="kategori">
                            @foreach ($data as $item)
                                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mt-2">
                        <label for="isi">Isi</label>
                        <textarea name="isi" class="my-editor form-control" id="my-editor" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="card-header">
                <a href="" class="btn btn-sm btn-light">Kembali</a>
                <button class="btn btn-sm btn-success float-right"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
@stop


@section('plugins.Sweetalert2', true)
@section('js')
    <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('my-editor');
    </script>

@stop
