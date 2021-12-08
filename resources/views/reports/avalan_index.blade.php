@extends('layouts.master')

@section('title')
    Laporan Avalan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Avalan
    </li>
@endsection

@section('content')

<table class="table table-responsive table-striped">
    <th>
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
    </th>
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



@endsection