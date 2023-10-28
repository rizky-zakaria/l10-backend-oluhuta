@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Merchant</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Daftar Merchant
            <a href="{{ route('merchant.create') }}" class="btn btn-sm btn-primary float-right"><i
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
                            Merchant
                        </th>
                        <th>
                            Telepon
                        </th>
                        <th>
                            Deskripsi
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
                                {{ $item->nama }}
                            </td>
                            <td>
                                {{ $item->phone }}
                            </td>
                            <td>
                                {{ $item->deskripsi }}
                            </td>
                            <td>
                                <img src="{{ asset($item->gambar->path) }}" width="100px" alt="">
                            </td>
                            <td>
                                <a href="{{ route('merchant.edit', $item->id) }}" class="btn btn-sm btn-success"><i
                                        class="fas fa-edit"></i></a>
                                <form action="{{ route('merchant.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fas fa-trash"></i></button>
                                </form>
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
