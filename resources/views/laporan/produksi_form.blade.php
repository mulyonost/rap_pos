<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-xl">
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('post')
            <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">ID Laporan</label>
                        <input type="text" class="form-control form-control-sm col-md-6" name="nomor" id="nomor" value= "">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control form-control-sm col-md-6" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Jumlah Billet</label>
                        <input type="text" class="form-control form-control-sm col-md-6" name="jumlah_billet" id="jumlah_billet">
                      </div>
                      <div class="form-group">
                        <label for="">Jumlah Avalan</label>
                        <input type="text" class="form-control form-control-sm col-md-6" name="jumlah_avalan" id="jumlah_avalan">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Mesin</label>
                        <select name="mesin" id="mesin" class="form-control form-control-sm col-md-3">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Shift</label>
                        <select name="shift" id="shift" class="custom-select form-control-sm col-md-3" size="2" required>
                          <option value="bohari">Bohari</option>
                          <option value="saldi">Saldi</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Foto</label>
                        <input class="form-control" type="file" name="foto" id="foto" >
                        <div class="col-md-5">
                          <img src="" name="showfoto" id="showfoto" class="img-thumbnail img-fluid"/>
                        </div>                        
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Anggota</label>
                        <textarea name="anggota" id="anggota" class="form-control" name="" id="" cols="30" rows="4"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="">Total Produksi</label>
                        <input type="text" class="form-control form-control-sm col-md-5" name="total" id="total" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table-bordered" width="100%" id="kas_table">
                      <thead>
                        <tr>
                          <th>No Matras</th>
                          <th width="30%">Nama Aluminium</th>
                          <th width="10%">Berat</th>
                          <th width="10%">Qty</th>
                          <th>Subtotal</th>
                          <th><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                        </tr>
                      </thead>
                      <tbody id="mainbody">

                      </tbody>
                    </table>               
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>
              <!-- /.modal-content -->
</form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

@push('scripts')

<script>
var numRows = 2, ti = 5;
function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

$(function() {
  $('#modal-form').on("keyup change blur shown.bs.modal", recalcProduksi);
});

$(function(){
  $('#tanggal').on("change click", getNomorProduksi);
})

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
  });

var i=0;
$('#add_new').click(function(){
  i++;
  $('#mainbody').append('<tr><td>' +
    '<input class="form-control" type="hidden" name="addmore[' +i+ '][id]" id="id' +i+ '" value="">' +
    '<input type="hidden" class="form-control id_aluminium" name="addmore[' +i+ '][id_aluminium]" id="id_aluminium' +i+ '" value="">' +
    '<input class="form-control" type="text" name="addmore['+i+'][matras]" id="matras'+i+'"></td>' +
    '<td><select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" required >' +
    '<option disabled="disabled" selected="selected" value="" >Select Produk</option>' +
      '@foreach($produk as $pro)' +
        '<option value="{{$pro->id}}" data-berat="{{ $pro->berat_maksimal }}">{{$pro->nama}}</option>' +
      '@endforeach' +
    '</select></td>' +
    '<td><input step=".001" class="form-control berat" type="number" name="addmore['+i+'][berat]" id="berat'+i+'" required ></td>' +
    '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required ></td>' +
    '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" required readonly></td>' +
    '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> -</button></td></tr>'
  )
  $('.nama').select2({
    theme: "bootstrap"
  });
});

$( document ).on('click', '.remove', function(event){
  jQuery(this).parent().parent().remove();
            return false;
});

</script>
@endpush
