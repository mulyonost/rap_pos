@extends('layouts.master')

@section('title')
    Laporan Produksi
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Produksi</li>
@endsection

@section('content')
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
    @foreach ($group as $produksi)
        <tr>
            <td>{{ $produksi->aluminium->nama }}</td>
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
@endsection