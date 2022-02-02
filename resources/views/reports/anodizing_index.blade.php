@extends('layouts.master')

@section('title')
    Laporan Anodizing
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Anodizing</li>
@endsection

@section('content')
<div class="row">
    <form action="{{ route('reports_anodizing.data') }}">
    <div class="row">        
            <div class="col ml-3">
                <label for="">Tanggal Awal</label>
                <input type="date" class="form-control" name="awal">
            </div>
            <div class="col">
                <label for="">Tanggal Akhir</label>
                <input type="date" class="form-control" name="akhir">
            </div>
            <div class="col">
                <div class="row mt-4">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>        
    </div>
</form>
</div>
<div class="row">
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
        @foreach ($anodizing as $a)
            <tr>
                <td>{{ $a->nama }}</td>
                <td>{{ number_format($a->qty) }}</td> 
                <td>{{ number_format($a->total) }} Kg</td> 
                <?php $grandtotal += $a->total; ?>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td><?php echo number_format($grandtotal); ?> kg</td>
            </tr>
        </tbody>

    </table>
</div>
@endsection