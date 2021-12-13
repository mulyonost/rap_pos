@extends('layouts.master')

@section('title')
    Penjualan Aluminium
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Penjualan Aluminium</li>
@endsection

@section('content')
<div class="row bg-light">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="alert alert-success alert-dismisible">
                    <i class="fa fa-check icon"></i>
                    Data berhasil disimpan
                </div>
                <div class="">
                    <a target="_blank" href="{{ route('penjualan_aluminium.cetaksj') }}" class="btn btn-warning" >Cetak Surat Jalan</a>
                    <a target="_blank" href="{{ route('penjualan_aluminium.cetaknota') }}" class="btn btn-warning" >Cetak Nota</a>
                    <a href="{{ url("penjualan/aluminium") }}" class="btn btn-primary">Kembali ke index</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

</script>
@endpush