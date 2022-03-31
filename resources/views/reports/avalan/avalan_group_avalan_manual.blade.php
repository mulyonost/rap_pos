@extends('layouts.master')

@section('title')
    Laporan Avalan Detail
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Avalan</li>
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
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
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%" id="dataTable">
                    <thead>
                        <th>Nama Avalan</th>
                        <th>Total Qty</th>
                        <th>Total Pembelian</th>
                        <th>Harga Rata-rata</th>
                    </thead>
                    <tbody>
                        <?php $qtyTotal = 0; ?>
                        <?php $subtotalTotal = 0; ?>
                        @foreach ($avalan as $av)
                        <tr>
                            <td>{{$av->nama}}</td>
                            <td>{{number_format($av->qty)}}</td>
                            <td>{{number_format($av->subtotal)}}</td>
                            <td>{{number_format($av->subtotal / $av->qty)}}</td>
                            <?php $qtyTotal += $av->qty; ?>
                            <?php $subtotalTotal += $av->subtotal; ?>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td><?= number_format($qtyTotal) ?></td>
                            <td><?= number_format($subtotalTotal) ?></td>
                            <td><?= number_format($subtotalTotal/($qtyTotal)) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection