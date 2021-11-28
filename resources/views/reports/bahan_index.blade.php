@extends('layouts.master')

@section('title')
    Laporan Bahan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Bahan
    </li>
@endsection

@section('content')

<table class="table table-responsive table-striped">
    <th>
        <tr>
            <td>Nama Bahan</td>
            <td>Qty</td>
            <td>Total</td>
            <td>Harga Rata-Rata</td>
        </tr>
    </th>
    <tbody>
        <?php $grandtotal = 0; ?>
        @foreach($group as $item)
        <tr>
            <td>{{ $item->items->nama }}</td>
            <td>{{ number_format($item->qty) }}</td>
            <td>{{ number_format($item->subtotal) }}</td>
            <?php $grandtotal += $item->subtotal; ?>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td>{{number_format($grandtotal)}}</td>
        </tr>
    </tfoot>
</table>



@endsection