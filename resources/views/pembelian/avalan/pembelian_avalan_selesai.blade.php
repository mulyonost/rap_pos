@extends('layouts.master')

@section('title')
    Pembelian Avalan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pembelian Avalan</li>
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
                    <a target="_blank" href="{{ route('pembelian_avalan.cetak') }}" class="btn btn-warning" onclick="return !window.open(this.href, 'somesite', 'width=900,height=700')" >Cetak Nota</a>
                    <a href="{{ url("pembelian/avalan") }}" class="btn btn-primary">Kembali ke index</a>
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