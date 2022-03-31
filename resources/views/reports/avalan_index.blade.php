@extends('layouts.master')

@section('title')
    Laporan Avalan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Avalan</li>
@endsection

@section('content')

<div class="row">
    <div class="row">
        <form class="form-inline" action="{{ route('reports_avalan.search') }}" >
            <div class="form-group mb-2">
                <label>Tanggal Awal</label>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="<?=  date("Y-m-01")  ?>">
            </div>
            <div class="form-group mb-2">
                <label>Tanggal Akhir</label>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="<?=  date("Y-m-d")  ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2" value="avalan" name="type">Avalan</button>
            <button type="submit" class="btn btn-primary mb-2 ml-2" value="supplier" name="type">Group Supplier</button>
            <button type="submit" class="btn btn-primary mb-2 ml-2" value="avalan_group" name="type">Group Avalan</button>
        </form>
        </div>
<div class="col-md-7">
<table class="table table-responsive table-striped">
    <thead>
        <tr>
            <td>Tanggal</td>
            <td>Supplier</td>
            <td>Nama Avalan</td>
            <td>Qty</td>
            <td>Potongan</td>
            <td>Qty Akhir</td>
            <td>Harga</td>
            <td>Total</td>
            <td>Harga Rata-Rata</td>
        </tr>
    </thead>
    <tbody>
        @foreach($pav as $avalan)
        <tr>
            <td>{{ $avalan->master->tanggal }}</td>
            <td>{{ $avalan->master->supplier->nama }}</td>
            <td>{{ $avalan->avalan->nama }}</td>
            <td>{{ number_format($avalan->qty) }}</td>
            <td>{{ number_format($avalan->potongan) }}</td>
            <td>{{ number_format($avalan->qty_akhir) }}</td>
            <td>{{ number_format($avalan->harga) }}</td>
            <td>{{ number_format($avalan->subtotal) }}</td>
            <td>{{ number_format($avalan->subtotal/$avalan->qty) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<div class="col-md-5">
    <table class="table table-responsive table-striped">
        <thead>
            <tr>
                <td>Nama Barang</td>
                <td>Total Qty</td>
                <td>Total Pembelian</td>
                <td>Harga Rata2</td>
            </tr>
        </thead>
        <tbody>
            <?php  $qtyTotal = 0; $hargaTotal = 0; ?>
            @foreach ($group as $g)
            <tr>
                <td>{{ $g->avalan->nama }}</td>
                <td>{{ number_format($g->qty) }}</td>
                <td>{{ number_format($g->subtotal) }}</td>
                <td>{{ number_format($g->subtotal / $g->qty) }}</td>
                <?php  $qtyTotal += $g->qty; $hargaTotal += $g->subtotal ?>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Rata2 Total</td>
                <td>{{ number_format($qtyTotal) }}</td>
                <td>{{ number_format($hargaTotal) }}</td>
                <td>{{ number_format($hargaTotal/$qtyTotal) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
</div>



@endsection