@extends('layouts.master')

@section('title')
    Laporan Produksi {{ $tanggalAwal ?? "Semua" }}   -   {{ $tanggalAkhir ?? "Data"}}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Produksi</li>
@endsection

@section('content')
<div class="row">
    <form action="{{ route('reports_produksi.date') }}">
        @csrf
        <label for="">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" value="{{ $tanggalAwal ?? date('Y-m-01') }}">
        <label for="">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir ?? date('Y-m-d')}}">
        <button type="submit" name="button" id="button" value="date">Submit</button>
        <button type="submit" name="button" id="button" value="all">Tampilkan Semua Data</button>
    </form>
</div>
<div class="row">
<table class="table table-bordered table-responsive">
    <thead>
        <tr>
            <td>Nama Barang</td>
            <td>Berat Rata-Rata</td>
            <td>Berat Min</td>
            <td>Berat Max</td>
            <td>Qty Btg</td>
            <td>Berat Total</td>
        </tr>
    </thead>
    <tbody>
        <?php  $grandtotal=0; ?>
        Total Rows : {{ $count }}
        @foreach ($produksi as $produksi)
        <tr>
            <td>{{ $produksi->nama }}</td>
            <td>{{ number_format($produksi->total / $produksi->qty, 3) }}</td>
            <td>{{ number_format($produksi->berat_min, 3) }}</td>
            <td>{{ number_format($produksi->berat_max, 3) }}</td>
            <td>{{ number_format($produksi->qty) }}</td> 
            <td>{{ number_format($produksi->total) }} Kg</td> 
            <?php $grandtotal += $produksi->total; ?>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo number_format($grandtotal); ?> kg</td>
        </tr>
    </tbody>

</table>
</div>
@endsection