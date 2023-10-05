@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Transaksi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Daftar Transaksi
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>
                            Nomor
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Produk
                        </th>
                        <th>
                            status
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
                                {{ $item->user->name }}
                            </td>
                            <td>
                                {{ $item->product->product }}
                            </td>

                            <td>
                                {{ $item->status }}
                            </td>
                            <td>
                                @if ($item->satstus === 'pending')
                                    <a href="" class="btn btn-sm btn-success">Tandai Selesai</a>
                                @else
                                    <a href="" class="btn btn-sm btn-secondary">Selesai</a>
                                @endif

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
