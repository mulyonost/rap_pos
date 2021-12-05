@extends('layouts.master')

@section('title')
    Laporan Produksi
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('reports_produksi.index') }}">Laporan Produksi</a></li>
@endsection

@section('content')
{{-- <div class="row">
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
</div> --}}
    <form action="{{ route('reports_produksi.search') }}" method="get">
    <div class="row">
        <div class="form-group row">
            <label class="col-sm-5 col-form-label">Tanggal Awal</label>
            <div class="col-sm-7 pl-0">
                <input type="date" class="form-control" id="awal" name="awal">
            </div>
        </div>
        <div class="form-group row ml-3">
            <label class="col-sm-5 col-form-label">Tanggal Akhir</label>
            <div class="col-sm-7 pl-0">
                <input type="date" class="form-control" id="akhir" name="akhir" value="{{ $tanggalAkhir ?? date('Y-m-d')}}">
            </div>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </div>
    </form>
    <div class="row mt-4">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Nama Barang</td>
                        <td>Berat Avg</td>
                        <td>Berat Min</td>
                        <td>Berat Max</td>
                        <td>Qty</td>
                        <td>Total Berat</td>
                        <td>Detail</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $grandtotal = 0; ?>
                    @foreach ($produksi as $p)
                    <tr>
                        <td>{{ $p->nama }}</td>
                        <td>{{ number_format($p->total / $p->qty, 3) }}</td>
                        <td>{{ number_format($p->berat_min, 3) }}</td>
                        <td>{{ number_format($p->berat_max, 3) }}</td>
                        <td>{{ number_format($p->qty) }}</td> 
                        <td>{{ number_format($p->total) }} Kg</td> 
                        <td>Detail Item</td>
                        <?php $grandtotal += $p->total; ?>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total Produksi</td>
                    <td><?php echo number_format($grandtotal); ?> kg</td>
                    <td></td>
                    <td></td>
                </tfoot>
            </table>
        </div>
    </div>
@endsection