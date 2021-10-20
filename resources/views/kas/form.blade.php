<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-xl">
    <form action="" method="post" class="form-horizontal">
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
                    <label for="id_kas" class="col-sm-2 col-form-label">ID Kas</label>
                    <div class="col-sm-4">
                      <input type="text" id="id_kas" name="id_kas" class="form_control"> 
                    </div>
                    <label for="total">Total</label>
                    <div class="col-sm-4">
                      <input type="text" id="total" name="total" class="form_control"> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-4">
                      <input type="date" id="tanggal" name="tanggal" class="form_control"> 
                    </div>
                  </div>

                  <div class="table-responsive">
                    <table class="table" width="100%">
                      <thead>
                        <tr>
                          <th>Nama Item</th>
                          <th>Kategori</th>
                          <th>Qty</th>
                          <th>Harga</th>
                          <th>Subtotal</th>
                          <th><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                        </tr>
                      </thead>
                      <tbody id="mainbody">
                        <tr>
                          <td><input type="text" name="addmore[0][nama]" id="nama0" required></td>
                          <td>
                            <select name="addmore[0][kategori]" id="kategori0">
                              <option disabled="disabled" selected="selected" value="">Pilih Kategori</option>
                              <option value="spare-part">Spare Part</option>
                              <option value="transportasi">Transportasi</option>
                            </select></td>
                          <td><input class="qty" type="number" name="addmore[0][qty]" id="qty0"></td>
                          <td><input class="harga" type="number" name="addmore[0][harga]" id=harga0></td>
                          <td><input class="subtotal" type="number" name="addmore[0][subtotal]" id="subtotal0"></td>
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
  var i=0;
  $('#add_new').click(function(){
    i++;
    $('#mainbody').append('<tr><td>' +
     '<input type="text" step="any" name="addmore['+i+'][nama]" id="nama'+i+'" required ></td>' +
     '<td><select name="addmore['+i+'][kategori]" id="kategori'+i+'">' +
     '<option disabled="disabled" selected="selected" value="">Pilih Kategori</option>' +
     '<option value ="spare-part">Spare Part</option>' +
     '<option value ="transportasi">Transportasi</option></td>' +
     '<td><input class="qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required ></td>' +
     '<td><input class="harga" type="number" name="addmore['+i+'][harga]" id="harga'+i+'" required ></td>' +
     '<td><input class="subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" required ></td>'
      )
  });

  $('input.qty,input.harga').keyup(function(){
    var subtotal = 0;
    var $row = $(this).closest("tr");
    var qty = parseFloat($row.find('.qty').val());
    var harga = parseFloat($row.find('.harga').val());
    subtotal = qty * harga ;

    $row.find('.subtotal').val(subtotal);

  })
    var $tr = $(this).closest('tr'),
        $qty = $tr.find('input.qty'),
        $harga = $tr.find('input.harga'),
        $subtotal = $tr.find('input.subtotal')
        $total = $('#total');

        $subtotal.val($qty.val() * $harga.val());

        // var grandtotal = 0;
        // $('#total').each(function(){
        //   if(!isNaN($(this)))
        // })

  });

</script>
@endpush
