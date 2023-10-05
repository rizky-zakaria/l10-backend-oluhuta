@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Merchant</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Daftar Merchant
            <a href="{{ route('konten.create') }}" class="btn btn-sm btn-primary float-right"><i
                    class="fas fa-plus-circle"></i>Tambah</a>
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
