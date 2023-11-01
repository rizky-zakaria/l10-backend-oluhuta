@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Merchant</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Daftar Merchant
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('konten.create') }}" class="btn btn-sm btn-primary float-right"><i
                        class="fas fa-plus-circle"></i>Tambah</a>
                <a href="{{ url('admin/laporan/data-wisata/print') }}" class="btn btn-sm btn-warning float-right"><i
                        class="fas fa-print"></i> Cetak</a>
            @else
                <a href="{{ url('pimpinan/laporan/data-wisata/print') }}" class="btn btn-sm btn-warning float-right"><i
                        class="fas fa-print"></i> Cetak</a>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Judul
                        </th>
                        <th>
                            Kategori
                        </th>
                        <th>
                            Gambar
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $item->judul }}
                            </td>
                            <td>
                                {{ $item->kategori->kategori }}
                            </td>
                            <td>
                                <img src="{{ asset($item->gambar->path) }}" width="100px" alt="">
                            </td>
                            <td>
                                <a href="{{ route('konten.edit', $item->id) }}" class="btn btn-sm btn-success"><i
                                        class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin Ingin Menghapus Data Ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <form action="{{ route('konten.destroy', $item->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('js')
    <script>
        $("#myTable").DataTable({
            "autoWidth": false,
            "responsive": true
        });
    </script>
@stop
