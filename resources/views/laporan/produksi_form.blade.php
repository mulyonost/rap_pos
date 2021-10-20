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
                  <div class="form-group row">
                    <label for="id_laporan" class="col-sm-2 col-form-label">ID Laporan</label>
                    <div class="col-sm-4">
                      <input type="text" id="id_laporan" name="id_laporan" class="form_control"> 
                    </div>
                    <label for="total">Total</label>
                    <div class="col-sm-4">
                      <input type="text" id="total" name="total" class="form_control" readonly> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-4">
                      <input type="date" id="tanggal" name="tanggal" class="form_control" value="<?php echo date('Y-m-d') ?>"> 
                    </div>
                  </div>

                  <div class="table-responsive">
                    <table class="" width="100%" id="kas_table">
                      <thead>
                        <tr>
                          <th>No Matras</th>
                          <th>Nama Aluminium</th>
                          <th>Berat</th>
                          <th>Qty</th>
                          <th>Subtotal</th>
                          <th><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                        </tr>
                      </thead>
                      <tbody id="mainbody">
                        <tr>
                          <td><input type="text" name="addmore[0][matras]" id="matras0" required></td>
                          <td><input type="text" name="addmore[0][nama]" id="nama0" required></td>
                          <td><input class="berat" type="number" name="addmore[0][berat]" id="berat0"></td>
                          <td><input class="qty" type="number" name="addmore[0][qty]" id=qty0></td>
                          <td><input class="subtotal" type="number" name="addmore[0][subtotal]" id="subtotal0" readonly></td>
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
    $(this).find('input.subtotal').val(Math.round(subtotal * 100) / 100);
    grandtotal += isNumber(subtotal)  ? subtotal : 0;
  });
  $('#total').val(Math.round(grandtotal * 100) / 100 );
}

$(function() {
  $('#kas_table').on("keyup blur", recalc); 
});



  var i=0;
  $('#add_new').click(function(){
    i++;
    $('#mainbody').append('<tr><td>' +
     '<input type="text" step="any" name="addmore['+i+'][matras]" id="matras'+i+'" required ></td>' +
     '<td><input type="text" step="any" name="addmore['+i+'][nama]" id="nama'+i+'" required ></td>' +
     '<td><input class="berat" type="number" name="addmore['+i+'][berat]" id="berat'+i+'" required ></td>' +
     '<td><input class="qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required ></td>' +
     '<td><input class="subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" required readonly></td>'
      )
  });

  // $('input.qty,input.harga').keyup(function(){
  //   var subtotal = 0;
  //   var $row = $(this).closest("tr");
  //   var qty = parseFloat($row.find('.qty').val());
  //   var harga = parseFloat($row.find('.harga').val());
  //   subtotal = qty * harga ;

  //   $row.find('.subtotal').val(subtotal);

  // })
  // //   var $tr = $(this).closest('tr'),
  // //       $qty = $tr.find('input.qty'),
  // //       $harga = $tr.find('input.harga'),
  // //       $subtotal = $tr.find('input.subtotal')
  // //       $total = $('#total');

  // //       $subtotal.val($qty.val() * $harga.val());

  // //       // var grandtotal = 0;
  // //       // $('#total').each(function(){
  // //       //   if(!isNaN($(this)))
  // //       // })

  // // });



</script>
@endpush
