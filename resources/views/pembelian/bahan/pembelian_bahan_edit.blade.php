@extends('layouts.master')

@section('title')
    Pembelian Bahan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('pembelian_bahan.index') }}">Pembelian Bahan</a></li>
@endsection

@section('content')


<div class="container-xxl avalan">
    <form action="{{ route('pembelian_bahan.update', $pbl->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-avalan" autocomplete="off" >
        @csrf
        @method('put')
        <div class="row pt-3">
            <div class="col-md-3">
              <div class="row">
                  <div class="col-md-5">
                      <label>Nomor Transaksi</label>
                  </div>
                  <div class="col-md-7">
                      <input type="text" class="form-control" name="nomor" id="nomor" value="{{ $pbl->nomor }}" required readonly>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-5">
                      <label>Tanggal Transaksi</label>
                  </div>
                  <div class="col-md-7">
                      <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $pbl->tanggal }}" required>
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
                        <option value="{{ $supplier->id }}" {{ $supplier->id == $pbl->id_supplier ? 'selected' : '' }}>{{ $supplier->nama }}</option>
                        @endforeach
                    </select>
                    <input class="form-control" type="hidden" name="nama_supp" id="nama_supp">
                </div>
              </div>
          </div>
          <div class="col-md-3">
            <div class="row">
                <div class="col-md-4">
                    <label>Jatuh Tempo</label>
                </div>
                <div class="col-md-7">
                    <input type="date" class="form-control" name="due_date" id="due_date" value="{{ $pbl->due_date }}" required>
                </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-4">
                      <label>Status Pelunasan</label>
                  </div>
                  <div class="col-md-7">
                      <select name="status" id="status" class="form-control" required>
                        <option value="0" {{ $pbl->status == 0 ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="1" {{ $pbl->status == 1 ? 'selected' : '' }}>Lunas</option>
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
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="4">{{ $pbl->keterangan }}</textarea>
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
            <h5 class="ml-2"> Detail Pembelian</h5>
        </div>
        <div class="row fixed-detail border border-secondary">
            <div class="col-md-9 border-right border-secondary overflow-auto scrollable">
                <table class="table" id="table-detail">
                    <thead>
                        <tr>
                        <th width="35%">Nama Barang</th>
                        <th width="20%">Qty</th>
                        <th width="20%">Harga</th>
                        <th width="20%">Subtotal</th>
                        <th width="5%"><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                        </tr>
                    </thead>
                    <tbody id="mainbody">
                    </tbody>
                    <tfoot class="table-sm table-borderless">
                        <tr>
                            <td colspan="3" class="text-right">Total Nota</td>
                            <td><input type="text" class="form-control total_nota" id="total_nota" name="total_nota" value="{{ $pbl->total }}" readonly></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-xl-3 col-foto">
                <div class="row">
                    <h4>Foto</h4>
                </div>
                <div class="row">
                    <a href="{{ asset('uploads/pembelian/bahan/'.$pbl->foto) }}" target="_blank" onclick="return !window.open(this.href, 'somesite', 'width=700,height=700')"><img src="{{ asset('uploads/pembelian/bahan/'.$pbl->foto) }}" class="img-fluid" width="50%"></a>
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
const items = @json($items);
const pbld = @json($pbld);

$(function() {
        $('#form-avalan').on("keyup change blur mouseenter", recalcPembelian);
    });

$(function() {
        $('#tanggal').on("change", getNomorPembelianBahan);
    });

var i = 0;

$(document).ready(function(){
    for (i=0; i<pbld.length; i++){
        addRowPembelian();
        populateSelectPembelian();
        $('#nama'+i+'').val(pbld[i].id_item);
        $('#qty'+i+'').val(pbld[i].qty);
        $('#harga'+i+'').val(pbld[i].harga);
        $('#subtotal'+i+'').val(pbld[i].subtotal);
    }
    
    i++;
    $('.nama').select2({
        theme: "bootstrap-5"
    });
    $('.supplier').select2({
        theme: "bootstrap-5"
    });

})

$('#add_new').click(function(){
    addRowPembelian();
    populateSelectPembelian();
    i++;
    $('.nama').select2({
        theme: "bootstrap-5"
    });
});

function selectProduct(e)
{
    let harga = $(e).find('option:selected').data('harga');
    $(e).parent().parent().find('input.harga').val(harga).text();            
}

$(function() {
        $('#customer').on("change click", getSupplier);
    });


</script>
@endpush