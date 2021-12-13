@extends('layouts.master')

@section('title')
   Edit Pembelian Avalan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('pembelian_avalan.index') }}">Pembelian Avalan</a></li>
@endsection

@section('content')

<div class="container-xxl avalan">
    <form action="{{ route('pembelian_avalan.update', $pav->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-avalan" autocomplete="off" >
        @csrf
        @method('put')
        <div class="row pt-3">
            <div class="col-md-3">
              <div class="row">
                  <div class="col-md-5">
                      <label>Nomor Transaksi</label>
                  </div>
                  <div class="col-md-7">
                      <input type="text" class="form-control" name="nomor" id="nomor" value="{{ $pav->nomor }}" required>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-5">
                      <label>Tanggal Transaksi</label>
                  </div>
                  <div class="col-md-7">
                      <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $pav->tanggal }}" required>
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-5">
                    <label>Supplier</label>
                </div>
                <div class="col-md-7">
                    <select class="form-control supplier" id="supplier" name="supplier">
                        <option value="" selected="" disabled>Pilih Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supplier->id == $pav->id_supplier ? 'selected' : '' }}>{{ $supplier->nama }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
          </div>
          <div class="col-md-3">
            <div class="row">
                <div class="col-md-4">
                    <label>Jatuh Tempo</label>
                </div>
                <div class="col-md-7">
                    <input type="date" class="form-control" name="due_date" id="due_date" value="{{ $pav->due_date }}" required>
                </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-4">
                      <label>Status</label>
                  </div>
                  <div class="col-md-7">
                      <select name="status" id="status" class="form-control" required>
                        <option value="0">Belum Lunas</option>
                        <option value="1">Lunas</option>
                      </select>
                  </div>
              </div>              
          </div>
          <div class="col-md-3">
            <div class="row">
                <div class="col-md-3">
                    <label>Keterangan</label>
                </div>
                <div class="col-md-9">
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="4">{{ $pav->keterangan }}</textarea>
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
            <h5 class="ml-2"> Detail Avalan</h5>
        </div>
        <div class="row fixed-detail border border-secondary">
            <div class="col-md-9 border-right border-secondary overflow-auto scrollable">
            <table class="table" id="table-detail">
                  <thead>
                    <tr>
                      <th width="20%">Nama Barang</th>
                      <th width="15%">Qty</th>
                      <th width="15%">Potongan</th>
                      <th width="15%">Qty Akhir</th>
                      <th width="15%">Harga</th>
                      <th width="15%">Subtotal</th>
                      <th width="5%"><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                  </tr>
                </thead>
                <tbody id="mainbody">
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right">Total Nota</td>
                        <td><input type="text" class="form-control total_nota" id="total" name="total" value="{{ $pav->total_nota }}" readonly></td>
                    </tr>
                </tfoot>
              </table>
            </div>
            <div class="col-xl-3 col-foto">
              <div class="row">
                  <h4>Foto Avalan / Timbangan</h4>
              </div>
              <div class="row">
                <a href="{{ asset('uploads/pembelian/avalan/' . $pav->foto_nota) }}" onClick="MyWindow=window.open('{{ asset('uploads/pembelian/avalan/' . $pav->foto_nota) }}','MyWindow','width=800,height=600'); return false;"><img src="{{ asset('uploads/pembelian/avalan/' . $pav->foto_nota) }}" class="img-fluid" alt="Responsive image"></a>  
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
const avalan = @json($avalan);
const pavd = @json($pavd)

$(function() {
        $('#form-avalan').on("keyup change blur mouseenter", recalcPembelianAvalan);
    });

$(function() {
        $('#tanggal').on("change", getNomorPembelianAvalan);
        $('#tanggal').on("change", getPembelianAvalanJT);
    });

var i = 0;

$(document).ready(function(){
    for (i=0; i<pavd.length; i++){
        addPembelianAvalanRow();
        populateSelectAvalan();
        $('#item'+i+'').val(pavd[i].id_avalan);
        $('#qty'+i+'').val(pavd[i].qty);
        $('#potongan'+i+'').val(pavd[i].potongan);
        $('#qty_akhir'+i+'').val(pavd[i].qty_akhir);
        $('#harga'+i+'').val(pavd[i].harga);
        $('#subtotal'+i+'').val(pavd[i].subtotal);
    }
    
    i++;
    $('.item').select2({
        theme: "bootstrap-5"
    });
    $('.supplier').select2({
        theme: "bootstrap-5"
    });

})

$('#add_new').click(function(){
    addPembelianAvalanRow();
    populateSelectAvalan();
    i++;
    $('.item').select2({
        theme: "bootstrap-5"
    });
});

function selectProduct(e)
{
    let harga = $(e).find('option:selected').data('harga');
    $(e).parent().parent().find('input.harga').val(harga).text();            
}


</script>
@endpush