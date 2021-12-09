@extends('layouts.master')

@section('title')
    Laporan Produksi
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Produksi</li>
@endsection

@section('content')

<div class="container-xxl produksi">
    <form action="{{ route('laporan_produksi.update', $produksi->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-produksi" autocomplete="off" >
        @csrf
        @method('put')
        <div class="row pt-3">
            <div class="col-md-3">
              <div class="row">
                  <div class="col-md-3">
                      <label>Nomor</label>
                  </div>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="nomor" id="nomor" value="{{ $produksi->nomor_laporan }}" required>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-3">
                      <label>Tanggal</label>
                  </div>
                  <div class="col-md-6">
                      <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $produksi->tanggal }}" required>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-3">
                      <label>Mesin</label>
                  </div>
                  <div class="col-md-6">
                      <select class="form-control" name="mesin" id="mesin" required>
                          <option value="1" selected>1</option>
                          <option value="2">2</option>
                      </select>
                  </div>
              </div>
          </div>
          <div class="col-md-3">
              <div class="row">
                  <div class="col-md-3">
                      <label>Shift</label>
                  </div>
                  <div class="col-md-6">
                      <select name="shift" id="shift" class="form-select" size="2" aria-label="size 2" required>
                        <option value="bohari" {{ $produksi->shift == "bohari" ? 'selected' : '' }}>Bohari</option>
                        <option value="saldi" {{ $produksi->shift == "saldi" ? 'selected' : '' }}>Saldi</option>
                      </select>
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-3">
                      <label>Keterangan</label>
                  </div>
                  <div class="col-md-6">
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <textarea class="form-control" name="anggota" id="anggota"></textarea>
                  </div>
              </div>
          </div>
          <div class="col-md-3">
              <div class="row">
                  <div class="col-md-5">
                      <label>Total Billet</label>
                  </div>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="jumlah_billet" id="jumlah_billet" value="{{ $produksi->jumlah_billet }}">
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-5">
                      <label>Total Avalan</label>
                  </div>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="jumlah_avalan" id="jumlah_avalan" value="{{ $produksi->jumlah_avalan }}">
                  </div>
              </div>
              <div class="row mt-3">
                  <div class="col-md-5">
                      <label>Total Produksi</label>
                  </div>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="total" id="total" value="{{ $produksi->total_produksi }}"readonly>
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
            <h5> Detail Barang Produksi</h5>
        </div>
        <div class="row fixed-detail border border-secondary">
            <div class="col-md-9 border-right border-secondary overflow-auto">
            <table class="table" id="detail_table">
                  <thead>
                    <tr>
                      <th width="15%">Matras</th>
                      <th width="35%">Nama Aluminium</th>
                      <th width="15%">Berat</th>
                      <th width="15%">Qty</th>
                      <th width="15%">Subtotal</th>
                      <th width="5%"><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                  </tr>
                </thead>
                <tbody id="mainbody">
                    @foreach ($produksidetail as $key=>$pdtl)
                    <tr>
                        <td><input class="form-control" type="hidden" name="addmore[{{ $key }}][id]" id="id{{ $key }}" value="{{ $pdtl->id }}">
                            <input class="form-control" type="text" name="addmore[{{ $key }}][matras]" id="matras{{ $key }}"></td>
                        <td><select class="form-control nama" name="addmore[{{ $key }}][nama]" id="nama{{ $key }}" required >
                            <option selected="selected" value="{{ $pdtl->id_aluminium_base }}" >{{ $pdtl->aluminium->nama }}</option>
                            @foreach($produk as $pro)
                            <option value="{{$pro->id}}" data-berat="{{ $pro->berat_maksimal }}">{{$pro->nama}}</option>
                            @endforeach
                        </select></td>
                        <td><input step=".001" class="form-control berat" type="number" name="addmore[{{ $key }}][berat]" id="berat{{ $key }}" value="{{ $pdtl->berat }}" required></td>
                        <td><input class="form-control qty" type="number" name="addmore[{{ $key }}][qty]" id="qty{{ $key }}" value="{{ $pdtl->qty }}" required ></td>
                        <td><input class="form-control subtotal" type="number" name="addmore[{{ $key }}][subtotal]" id="subtotal{{ $key }}" value="{{ $pdtl->total }}" required readonly></td>
                        <td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> -</button></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="col-xl-3 col-foto">
              <div class="row">
                  <h4>Foto Laporan</h4>
              </div>
              <div class="row">
                Ini nanti diisi dengan foto yang sudah diupload</div>
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
  $('#form-produksi').on("keyup change blur", recalcProduksi);
});

var i=0;
function addRowProduksi(){
    $('#mainbody').append('<tr><td>' +
        '<input class="form-control" type="hidden" name="addmore[' +i+ '][id]" id="id' +i+ '" value="">' +
        '<input class="form-control" type="text" name="addmore['+i+'][matras]" id="matras'+i+'"></td>' +
        '<td><select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" required >' +
            '<option disabled="disabled" selected="selected" value="" >Select Produk</option>' +
            '@foreach($produk as $pro)' +
            '<option value="{{$pro->id}}" data-berat="{{ $pro->berat_maksimal }}">{{$pro->nama}}</option>' +
            '@endforeach' +
            '</select></td>' +
        '<td><input step=".001" class="form-control berat" type="number" name="addmore['+i+'][berat]" id="berat'+i+'" required></td>' +
        '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required ></td>' +
        '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" required readonly></td>' +
        '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> -</button></td></tr>'
        )
}

$(document).ready(function(){
    $('.nama').select2({
        theme: "bootstrap-5"
    })
})

$('#add_new').click(function(){
  addRowProduksi();
  i++;
  $('.nama').select2({
    theme: "bootstrap-5"
  });
});

$(function(){
  $('#tanggal').on("change", getNomorProduksi);
});

var imageLoader = document.getElementById('filePhoto');
    imageLoader.addEventListener('change', handleImage, false);

function handleImage(e) {
    var reader = new FileReader();
    reader.onload = function (event) {
        
        $('.uploader img').attr('src',event.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
}

</script>
@endpush