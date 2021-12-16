@extends('layouts.master')
{{-- <?= dd($groupout); ?> --}}
@section('title')
    Laporan Packing
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Packing
    </li>
@endsection

@section('content')
<div class="row">
<div class=col-md-4>
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
            <td><a href="{{ route('reports_packing.show', $produksi->id_aluminium) }}">Detail</a></td>
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
</div>
<div class="col-md-4">
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <td>Nama Barang</td>
                <td>Total Colly</td>
                <td>Total Btg</td>
            </tr>
        </thead>
        <tbody>
            <?php  $grandtotal=0; ?>
        @foreach ($groupout as $produksi)
            <tr>
                <td>{{ $produksi->aluminium->nama }}</td>
                <td>{{ number_format($produksi->colly) }}</td> 
                <td>{{ number_format($produksi->qty) }}</td> 
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="col-md-4">
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Stock</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stock as $s)
            <?php $subtotal=$s->quantity * $s->harga_jual ?>
            <tr>
                <td>{{ $s->nama }}</td>
                <td>{{ number_format($s->quantity) }}</td>
                <td>{{ number_format($s->harga_jual) }}</td>
                <td>{{ number_format($subtotal) }}</td>
            </tr>
            <?php $grandtotal += $subtotal ?>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ number_format($grandtotal) }}</td>
            </tr>
        </tfoot>

    </table>
</div>
</div>
@endsection