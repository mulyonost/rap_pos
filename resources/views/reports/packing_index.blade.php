@extends('layouts.master')

@section('title')
    Laporan Packing
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Packing
    </li>
@endsection

@section('content')
<table class="table table-bordered table-responsive">
    <thead>
        <tr>
            <td>Nama Barang</td>
            <td>Total Colly</td>
            <td>Total Btg</td>
            <td>Total Kg</td>
            <td>Detail</td>
        </tr>
    </thead>
    <tbody>
        <?php  $grandtotal=0; ?>
    @foreach ($group as $produksi)
        <tr>
            <?php $berat = $produksi->aluminium->berat_maksimal * $produksi->btg; ?>
            <td>{{ $produksi->aluminium->nama }}</td>
            <td>{{ number_format($produksi->colly) }}</td> 
            <td>{{ number_format($produksi->btg) }}</td> 
            <td>{{ number_format($berat) }} Kg</td> 
            <td><a href="{{ route('packingreports.show', $produksi->id_aluminium) }}">Detail</a></td>
            <?php $grandtotal += $berat; ?>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo number_format($grandtotal); ?> kg</td>
        </tr>
    </tbody>

</table>
@endsection