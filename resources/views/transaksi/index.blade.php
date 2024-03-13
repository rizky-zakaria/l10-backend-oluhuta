@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Transaksi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Daftar Transaksi
            @if (Auth::user()->role === 'pimpinan')
                <a href="{{ url('pimpinan/laporan/data-transaksi/print') }}" class="btn btn-warning btn-sm float-right"><i
                        class="fas fa-print"></i> Cetak</a>
            @endif
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
                            Harga
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
                                {{ $item->harga }}
                            </td>
                            <td>
                                {{ $item->product->product }}
                            </td>
                            <td>
                                {{ $item->status }}
                            </td>
                            <td>
                                @if ($item->product->kategori === 'sewa')
                                    @if ($item->status !== 'capture')
                                        <a href="{{ url('admin/transaksi/' . $item->id . '/selesai') }}"
                                            class="btn btn-sm btn-success">Tandai Selesai</a>
                                    @else
                                        <a href="" class="btn btn-sm btn-secondary">Selesai</a>
                                    @endif
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
