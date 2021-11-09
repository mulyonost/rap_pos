@extends('layouts.master')

@section('title')
    Laporan Packing Berdasarkan Aluminium
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Packing Berdasarkan Aluminium
    </li>
@endsection

@section('content')
<a href="{{ route('packingreports.index') }}">Back</a>
<h2>{{ $aluminium->nama }}</h2>
<table class="table table-bordered table-responsive">
    <thead>
        <tr>
            <td>Tanggal</td>
            <td>Total Colly</td>
            <td>Total Isi</td>
            <td>Total Btg</td>
        </tr>
    </thead>
    <tbody>
    @foreach ($packingdetail as $detail)
        <tr>
            <td>{{ $detail->master->tanggal }}</td>
            <td>{{ number_format($detail->qty_colly) }}</td> 
            <td>{{ number_format($detail->qty_isi) }}</td> 
            <td>{{ number_format($detail->qty_subtotal) }}</td> 
        </tr>
        @endforeach
    </tbody>

</table>
@endsection