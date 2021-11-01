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
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">ID Laporan</label>
                      <input type="text" class="form-control form-control-sm col-md-6" name="nomor" id="nomor" required readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Tanggal</label>
                      <input type="date" class="form-control form-control-sm col-md-6" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Keterangan</label>
                      <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="4"></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                      <label for="">Total Btg</label>
                      <input type="number" class="form-control form-control-sm col-md-6" name="total_btg" id="total_btg" readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Total Colly</label>
                      <input type="number" class="form-control form-control-sm col-md-6" name="total_colly" id="total_colly" readonly>
                    </div>
                    <div class="form-group">
                      <label for="">Foto</label>
                      <input class="form-control" type="file" name="foto" id="foto" >
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table-bordered" width="100%" id="kas_table">
                    <thead>
                      <tr>
                        <th width="40%">Nama Aluminium</th>
                        <th width="10%">Colly</th>
                        <th width="10%">Btg</th>
                        <th>Subtotal Btg</th>
                        <th><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                      </tr>
                    </thead>
                    <tbody id="mainbody">
                      <tr>
                        <td><select class="form-control nama" name="addmore[0][nama]" id="nama0" required >
                            <option disabled="disabled" selected="selected" value="" >Select Produk</option>
                            @foreach($produk as $pro)
                                <option value="{{$pro->id}}">{{$pro->nama}}</option>
                            @endforeach
                        </select></td>
                          <td><input class="form-control qty" type="number" name="addmore[0][qty]" id=qty0 required></td>
                        <td><input step=".001" class="form-control berat" type="number" name="addmore[0][berat]" id="berat0" required></td>
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
var grandtotalbtg = 0;
$('#kas_table').find('tr').each(function() {
  var berat = $(this).find('input.berat').val();
  var qty = $(this).find('input.qty').val();
  var subtotal = (berat * qty);
  var subtotalbtg = (qty * 1);
  $(this).find('input.subtotal').val(Math.round(subtotal * 100) / 100);
  grandtotal += isNumber(subtotal)  ? subtotal : 0;
  grandtotalbtg += isNumber(subtotalbtg) ? subtotalbtg : 0;
});
$('#total_btg').val(Math.round(grandtotal * 100) / 100 );
$('#total_colly').val(grandtotalbtg);
}

function getdate() {
var date= $('#tanggal').val();
var newDate = date.replace(/-/g, "");
$('#nomor').val(newDate);
}

$(function() {
$('#modal-form').on("keyup change blur", recalc).on("keyup change click blur", getdate);
});



var i=0;
$('#add_new').click(function(){
i++;
$('#mainbody').append('<tr><td>' +
  '<select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" required >' +
  '<option disabled="disabled" selected="selected" value="" >Select Produk</option>' +
    '@foreach($produk as $pro)' +
      '<option value="{{$pro->id}}" data-berat="{{ $pro->berat_maksimal }}">{{$pro->nama}}</option>' +
    '@endforeach' +
  '</select></td>' +
  '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required ></td>' +
  '<td><input step=".001" class="form-control berat" type="number" name="addmore['+i+'][berat]" id="berat'+i+'" required ></td>' +
  '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" required readonly></td>' +
  '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> -</button></td></tr>'
)
});

$( document ).on('click', '.remove', function(event){
  jQuery(this).parent().parent().remove();
            return false;
});

</script>
@endpush
