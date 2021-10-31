<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-xl">
    <form action="" method="post" class="form-horizontal" autocomplete="off">
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
                        <input type="text" class="form-control form-control-sm col-md-6" name="nomor" id="nomor" value= "{{ $nomor }}">
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
                        <select name="shift" id="shift" class="form-control form-control-sm col-md-3">
                          <option value="1">1</option>
                          <option value="2">2</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Foto</label>
                        <input class="form-control" type="file" name="foto" id="foto" >
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
                        <tr>
                          <td><input class="form-control" type="text" name="addmore[0][matras]" id="matras0"></td>
                          <td><select class="form-control nama" name="addmore[0][nama]" id="nama0" required >
                              <option disabled="disabled" selected="selected" value="" >Select Produk</option>
                              @foreach($produk as $pro)
                                  <option value="{{$pro->id}}" data-berat="{{ $pro->berat_maksimal }}">{{$pro->nama}}</option>
                              @endforeach
                          </select></td>
                          {{-- <td><input class="form-control nama" type="text" name="addmore[0][nama]" id="nama0" required></td> --}}
                          <td><input step=".001" class="form-control berat" type="number" name="addmore[0][berat]" id="berat0" required></td>
                          <td><input class="form-control qty" type="number" name="addmore[0][qty]" id=qty0 required></td>
                          <td><input class="form-control subtotal" type="number" name="addmore[0][subtotal]" id="subtotal0" readonly></td>
                          <td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> -</button></td>
                        </tr>
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

function recalc() {
  var berat = 0;
  var qty = 0;
  var grandtotal = 0;
  $('#kas_table').find('tr').each(function() {
    var berat = $(this).find('input.berat').val();
    var qty = $(this).find('input.qty').val();
    var subtotal = (berat * qty);
    let berat_max = $(this).find('option:selected').data('berat');
    $(this).find('input.subtotal').val(Math.round(subtotal * 100) / 100);
    // $(this).find('input.berat').val(berat_max);
    grandtotal += isNumber(subtotal)  ? subtotal : 0;
  });
  $('#total').val(Math.round(grandtotal * 100) / 100 );
}

$(function() {
  $('#kas_table').on("keyup change blur", recalc);
});

$(document).ready(function () {
  $('.nama').select2({
    theme: "bootstrap"
  })
});

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
  });

var i=0;
$('#add_new').click(function(){
  i++;
  $('#mainbody').append('<tr><td>' +
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
