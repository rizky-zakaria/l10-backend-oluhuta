@extends('adminlte::page')

@section('title', 'Laporan Transaksi')

@section('content_header')
    <h1>Laporan Kunjungan</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            Laporan Kunjungan
        </div>
        <div class="card-body">
            <form action="{{ url('admin/laporan/kunjungan/cetak') }}" method="post">
                @csrf
                @php
                    $tahun = date('Y');
                    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                @endphp
                <div class="form-row">
                    <div class="col-4">
                        <select name="tahun" id="tahun" class='form-control'>
                            @php
                                for ($i = 0; $i < 5; $i++) {
                                    echo "<option value='" . $tahun - $i . "'>" . $tahun - $i . '</option>';
                                }
                            @endphp
                        </select>
                    </div>
                    <div class="col-4">
                        <select name="bulan" id="bulan" class='form-control'>
                            @php
                                for ($i = 0; $i < 12; $i++) {
                                    echo "<option value='" . $bln[$i] . "'>" . $bulan[$i] . '</option>';
                                }
                            @endphp
                        </select>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-md btn-warning w-100"><i class="fas fa-print"></i>
                            Cetak</button>
                    </div>
                </div>
            </form>
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
