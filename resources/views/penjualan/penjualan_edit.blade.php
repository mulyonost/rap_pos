@extends('layouts.master')

@section('title')
    Edit Penjualan Aluminium
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('penjualan_aluminium.index') }}">Edit Penjualan Aluminium</a></li>
@endsection

@section('content')


<div class="container-xxl avalan">
    <form action="{{ route('penjualan_aluminium.update', $penjualan->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-avalan" autocomplete="off" >
        @csrf
        @method('put')
        <div class="row pt-3">
            <div class="col-md-3">
              <div class="row">
                  <div class="col-md-5">
                      <label>Nomor Transaksi</label>
                  </div>
                  <div class="col-md-7">
                      <input type="text" class="form-control" name="nomor" id="nomor" value="{{ $penjualan->nomor }}" required>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-5">
                      <label>Tanggal Transaksi</label>
                  </div>
                  <div class="col-md-7">
                      <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $penjualan->tanggal }}" required>
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-5">
                    <label>Customer</label>
                </div>
                <div class="col-md-7">
                    <select class="form-control customer" id="customer" name="customer">
                        <option value="" selected="" disabled>Pilih Customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $customer->id == $penjualan->id_customer ? 'selected' : '' }}>{{ $customer->nama }}</option>
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
                    <input type="date" class="form-control" name="due_date" id="due_date" value="{{ $penjualan->due_date }}" required>
                </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-4">
                      <label>Status Pelunasan</label>
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
                    <label>Timbangan</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="timbangan" id="timbangan" value="{{ $penjualan->timbangan_mobil }}">
                </div>
              </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label>Keterangan</label>
                </div>
                <div class="col-md-9">
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="4">{{ $penjualan->keterangan }}</textarea>
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
                      <th width="30%">Nama Aluminium</th>
                      <th width="10%">Colly</th>
                      <th width="10%">Isi</th>
                      <th width="10%">Qty</th>
                      <th width="15%">Harga</th>
                      <th width="20%">Subtotal</th>
                      <th width="5%"><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                  </tr>
                </thead>
                <tbody id="mainbody">
                </tbody>
                <tfoot class="table-sm table-borderless">
                    <tr>
                        <td colspan="5" class="text-right">Total Nota</td>
                        <td><input type="text" class="form-control total_nota" id="total_nota" name="total_nota" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Diskon</td>
                        <td><input type="text" class="form-control diskon_persen" id="diskon_persen" name="diskon_persen"></td>
                        <td><input type="text" class="form-control diskon_rupiah" id="diskon_rupiah" name="diskon_rupiah" value="{{ $penjualan->diskon }}"></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">Total Akhir</td>
                        <td><input type="text" class="form-control total_akhir" id="total_akhir" name="total_akhir" readonly></td>
                    </tr>
                </tfoot>
              </table>
            </div>
            <div class="col-xl-3 col-foto">
              <div class="row">
                  <h4>Foto</h4>
              </div>
              <div class="row">
                Belum ada foto yang diupload</div>
              </div>
            </div>
        <div class="row mt-3">
            <div class="col-md-6">

            </div>  
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary float-right ml-4">Simpan</button>
            <button type="button" name="payment" id="payment" class="btn btn-default" data-toggle="modal" onclick="addPayment('{{ route('penjualan_aluminium.payment') }}')">Pembayaran</button>
            <a target="_blank" href="{{ route('penjualan_aluminium.cetakulangsj', $penjualan->id)}}" class="btn btn-secondary float-right ml-2">Cetak Ulang SJ</a>
            <a target="_blank" href="{{ route('penjualan_aluminium.cetakulangnota', $penjualan->id)}}" class="btn btn-secondary float-right">Cetak Ulang Nota</a>
        </div>
        </div>
    </form>
  </div>

@includeif('penjualan.penjualan_payment');
@endsection

@push('scripts')
<script>
const aluminium = @json($aluminium);
const penjualan = @json($penjualan);
const pdetail = @json($penjualandetail);

$(function() {
    $('#form-avalan').on("keyup change blur mouseenter", recalcPenjualan);
    });

$(function() {
    $('#diskon_persen').on("change", recalcDiskon);
});

$(function() {
    $('#tanggal').on("change", getNomorPenjualan);
});

var i = 0;

$(document).ready(function(){
    for (i=0; i<pdetail.length; i++){
        addRowPenjualan();
        populateSelectPenjualan();
        $('#nama'+i+'').val(pdetail[i].id_aluminium);
        $('#colly'+i+'').val(pdetail[i].colly);
        $('#isi'+i+'').val(pdetail[i].isi);
        $('#qty'+i+'').val(pdetail[i].qty);
        $('#harga'+i+'').val(pdetail[i].harga);
        $('#subtotal'+i+'').val(pdetail[i].subtotal);
        recalcPenjualan();
    }

    i++;
    $('.nama').select2({
        theme: "bootstrap-5"
    });
    $('.customer').select2({
        theme: "bootstrap-5"
    });

})

$('#add_new').click(function(){
    addRowPenjualan();
    populateSelectPenjualan();
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

function addPayment(url){
    $('#modal-form-payment').modal('show');
    $('#modal-form-payment .modal-title').text('Pembayaran Penjualan Aluminium');
    $('#modal-form-payment form').attr('action', url);
    $('#modal-form-payment [name=_method]').val('post');
    $('#modal-form-payment [name=sisa]').val(penjualan.total_akhir);
}
    

</script>
@endpush