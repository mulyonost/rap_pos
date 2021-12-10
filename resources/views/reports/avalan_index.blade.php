@extends('layouts.master')

@section('title')
    Laporan Avalan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Avalan</li>
@endsection

@section('content')

<video width="320" height="240" autoplay controls>
    <source src="%rtsp://admin:LJOCFW@192.168.0.101:554/H.264%" type="video/mp4">
    <object width="320" height="240" type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.5.swf">
        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.5.swf" /> 
        <param name="flashvars" value='config={"clip": {"url": "%rtsp://admin:LJOCFW@192.168.0.101:554/H.264%", "autoPlay":true, "autoBuffering":true}}' /> 
        <p><a href="%rtsp://admin:LJOCFW@192.168.0.101:554/H.264%">view with external app</a></p> 
    </object>
</video>


<div class="row">
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