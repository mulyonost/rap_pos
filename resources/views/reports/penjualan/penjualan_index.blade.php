@extends('layouts.master')

@section('title')
    Laporan Penjualan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Penjualan</li>
@endsection

@section('content')

<div class="row">
    <form class="form-inline" action="{{ route('reports_penjualan.search') }}" >
        <div class="form-group mb-2">
            <label>Tanggal Awal</label>
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="date" class="form-control" id="tanggal-awal" name="tanggal-awal" value="<?=  date("Y-m-01")  ?>">
        </div>
        <div class="form-group mb-2">
            <label>Tanggal Akhir</label>
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <input type="date" class="form-control" id="tanggal-akhir" name="tanggal-akhir" value="<?=  date("Y-m-d")  ?>">
        </div>
        <div class="form-group mb-2">
            <label>Group</label>
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <select name="group" id="group" class="form-control">
                <option value="none">None</option>
                <option value="item">Nama Barang</option>
                <option value="customer">Nama Customer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Cari</button>
    </form>
</div>
<div class="row mt-3">
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Tanggal Penjualan</th>
                <th>Nama Customer</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Barang</th>
                <th>Subtotal Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $jual)
            <tr>
                <td>{{$jual->master->tanggal}}</td>
                <td>{{$jual->master->customer->nama}}</td>
                <td>{{$jual->aluminium->nama}}</td>
                <td>{{ number_format($jual->qty)}}</td>
                <td>{{ number_format($jual->harga)}}</td>
                <td>{{ number_format($jual->subtotal)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection