@extends('adminlte::page')

@section('title', 'UMKM Lokal')

@section('content_header')
    <h1>UMKM Lokal</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Daftar UMKM Lokal
            <a href="{{ route('umkm-lokal.create') }}" class="btn btn-sm btn-primary float-right"><i
                    class="fas fa-plus-circle"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Merchant
                        </th>
                        <th>
                            Produk
                        </th>
                        <th>
                            Harga
                        </th>
                        <th>
                            Stok
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
                                {{ $item->merchant->nama }}
                            </td>
                            <td>
                                {{ $item->product }}
                            </td>
                            <td>
                                {{ $item->harga }}
                            </td>
                            <td>
                                {{ $item->stok }}
                            </td>
                            <td>
                                <img src="{{ asset($item->gambar->path) }}" width="100px" alt="">
                            </td>
                            <td>
                                <a href="{{ route('umkm-lokal.edit', $item->id) }}" class="btn btn-sm btn-success"><i
                                        class="fas fa-edit"></i></a>
                                <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
