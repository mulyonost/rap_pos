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
            <td>Nama Avalan</td>
            <td>Qty</td>
            <td>Total</td>
            <td>Harga Rata-Rata</td>
        </tr>
    </th>
    <tbody>
        @foreach($group as $avalan)
        <tr>
            <td>{{ $avalan->avalan->nama }}</td>
            <td>{{ number_format($avalan->qty) }}</td>
            <td>{{ number_format($avalan->subtotal) }}</td>
            <td>{{ number_format($avalan->subtotal/$avalan->qty) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection