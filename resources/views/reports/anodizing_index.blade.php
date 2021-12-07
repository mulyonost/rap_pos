@extends('layouts.master')

@section('title')
    Laporan Anodizing
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Anodizing</li>
@endsection

@section('content')

<table class="table table-bordered table-responsive">
    <thead>
        <tr>
            <td>Nama Barang</td>
            <td>Qty Btg</td>
            <td>Berat Total</td>
        </tr>
    </thead>
    <tbody>
        <?php  $grandtotal=0; ?>
    @foreach ($group as $produksi)
        <tr>
            <td>{{ $produksi->aluminium->nama }}</td>
            <td>{{ number_format($produksi->qty) }}</td> 
            <td>{{ number_format($produksi->total) }} Kg</td> 
            <?php $grandtotal += $produksi->total; ?>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td><?php echo number_format($grandtotal); ?> kg</td>
        </tr>
    </tbody>

</table>
@endsection