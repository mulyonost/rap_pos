@extends('layouts.master')

@section('title')
    Edit Laporan Packing
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Packing</li>
@endsection

@section('content')

<div class="container-xxl produksi">
    <form action="{{ route('laporan_packing.update', $packing->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-packing" autocomplete="off" >
        @csrf
        @method('put')
        <div class="row pt-3">
            <div class="col-md-3">
              <div class="row">
                  <div class="col-md-3">
                      <label>ID Laporan</label>
                  </div>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="nomor" id="nomor" value="{{ $packing->nomor }}" required>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-3">
                      <label>Tanggal</label>
                  </div>
                  <div class="col-md-6">
                      <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $packing->tanggal }}" required>
                  </div>
              </div>
          </div>
          <div class="col-md-3">
              <div class="row">
                  <div class="col-md-3">
                      <label>Keterangan</label>
                  </div>
                  <div class="col-md-6">
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <textarea class="form-control" name="keterangan" id="keterangan">{{ $packing->keterangan }}</textarea>
                  </div>
              </div>
          </div>
          <div class="col-md-3">
              <div class="row">
                  <div class="col-md-3">
                      <label>Total Btg</label>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control form-control-sm" name="total_btg" id="total_btg" value="{{ $packing->total_btg }}" readonly>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-3">
                      <label>Total Colly</label>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control form-control-sm" name="total_colly" id="total_colly" value="{{ $packing->total_colly }}" readonly>
                  </div>
              </div>
          </div>
          <div class="col-md-3">
            <div class="uploader" onclick="$('#filePhoto').click()">
                Klik atau drag and drop foto yang akan diupload
                <img src=""/>
                <input type="file" name="foto"  id="filePhoto" />
            </div>
          </div>
        </div>
        <div class="row mt-3 mb-2">
            <h5> Detail Barang Packing</h5>
        </div>
        <div class="row fixed-detail border border-secondary">
            <div class="col-md-9 border-right border-secondary overflow-auto">
            <table class="table" id="detail_table">
                  <thead>
                    <tr>
                        <th width="40%">Nama Aluminium</th>
                        <th width="10%">Colly</th>
                        <th width="10%">Batang</th>
                        <th>Subtotal Batang</th>
                        <th><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                  </tr>
                </thead>
                <tbody id="mainbody">
                </tbody>
              </table>
            </div>
            <div class="col-xl-3 col-foto">
              <div class="row">
                  <h4>Foto Laporan</h4>
              </div>
              <div class="row">
                <a href="{{ asset('uploads/laporan/packing/' . $packing->foto) }}" onClick="MyWindow=window.open('{{ asset('uploads/laporan/packing/' . $packing->foto) }}','MyWindow','width=800,height=600'); return false;"><img src="{{ asset('uploads/laporan/packing/' . $packing->foto) }}" class="img-fluid" alt="Responsive image"></a>  
            </div>
              </div>
            </div>
        <div class="row mt-3">
            <div class="col-md-6">

            </div>  
        <div class="col-md-6">
        <button type="submit" class="btn btn-primary float-right">Simpan</button>
        </div>
        </div>
    </form>
  </div>


@endsection

@push('scripts')

<script>

$(function() {
  $('#form-packing').on("keyup change blur mouseenter", recalcPacking);
});

const produk = @json($produk);
const packingDetail = @json($packingdetail);

var i = 0;
$(document).ready(function(){
    if(packingDetail.length > 0){
        for (i=0 ; i < packingDetail.length; i++){
            addRowPacking();
            for (e = 0; e < produk.length; e++){ 
                $('.nama').append( '<option value="'+ produk[e].id +'" data-berat="'+ produk[e].berat_maksimal +'">'+ produk[e].nama +'</option>' );
            }
            $('#id'+i+'').val(packingDetail[i].id);
            $('#nama'+i+'').val(packingDetail[i].id_aluminium);
            $('#colly'+i+'').val(packingDetail[i].qty_colly);
            $('#isi'+i+'').val(packingDetail[i].qty_isi);
        }
    }
    i++;
    $('.nama').select2({
        theme: "bootstrap-5"
    });
    recalcPacking();
})

$('#add_new').click(function(){
  addRowPacking();
  i++;
  $('.nama').select2({
    theme: "bootstrap-5"
  });
  for (e = 0; e < produk.length; e++){ 
    $('.nama').append( '<option value="'+ produk[e].id +'" data-berat="'+ produk[e].berat_maksimal +'">'+ produk[e].nama +'</option>' );
    }
});

$(function(){
  $('#tanggal').on("change", getNomorPacking);
});

</script>
@endpush