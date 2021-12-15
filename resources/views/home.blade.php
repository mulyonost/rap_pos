@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <h5 class="card-header">Input Laporan</h5>
        <div class="card-body">
          <a href="{{ route('laporan_produksi.create') }}" class="btn btn-primary">Laporan Produksi</a>
          <a href="{{ route('laporan_anodizing.create') }}" class="btn btn-primary">Laporan Anodizing</a>
          <a href="{{ route('laporan_packing.create') }}" class="btn btn-primary">Laporan Packing</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <h5 class="card-header">Input Pembelian</h5>
        <div class="card-body">
          <a href="{{ route('pembelian_bahan.create') }}" class="btn btn-primary">Bahan</a>
          <a href="{{ route('pembelian_avalan.create') }}" class="btn btn-primary">Avalan</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <h5 class="card-header">Input Penjualan</h5>
        <div class="card-body">
          <a href="{{ route('penjualan_aluminium.create') }}" class="btn btn-primary">Penjualan Aluminium</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3>Avalan Jatuh Tempo</h3>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Tanggal Pembelian</th>
                <th>Nomor</th>
                <th>Nama Supplier</th>
                <th>Total Nota</th>
                <th>Jatuh Tempo</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pav as $p)
                <tr>
                  <td>{{ $p->tanggal }}</td>
                  <td>{{ $p->nomor }}</td>
                  <td>{{ $p->supplier->nama }}</td>
                  <td>{{ number_format($p->total_nota) }}</td>
                  <td>{{ $p->due_date }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h3>Bahan Jatuh Tempo</h3>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Tanggal Pembelian</th>
                <th>Nomor</th>
                <th>Nama Supplier</th>
                <th>Total Nota</th>
                <th>Jatuh Tempo</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($pb as $p)
                <tr>
                  <td>{{ $p->tanggal }}</td>
                  <td>{{ $p->nomor }}</td>
                  <td>{{ $p->supplier->nama }}</td>
                  <td>{{ number_format($p->total) }}</td>
                  <td>{{ $p->due_date }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    Total Pembelian Bahan : {{ number_format($tpb) }} <br>
    Total Pembelian Avalan : {{ number_format($tpav) }}<br>
    <?php $tp = $tpb + $tpav ?>
    <?php $tutang = $utangavalan+$utangbahan ?>
    Total Pengeluaran : {{ number_format($tp) }} <br>
    Total Penjualan : {{ number_format($tj) }}<br>

    Selisih : {{ number_format($tj-$tp) }}<br>

    Utang : {{ number_format($tutang) }}<br>
  </div>
@endsection