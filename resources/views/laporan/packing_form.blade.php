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
                      <div class="col-md-5">
                        <a href="" name="link" id="link" target="_blank"><img src="" name="showfoto" id="showfoto" class="img-thumbnail"></a>
                        <span class="help-block with-errors"></span>
                      </div>
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

$(function() {
$('#modal-form').on("keyup change blur shown.bs.modal", recalcPacking);
});

$(function() {
$('#modal-form').on("keyup change click blur", getNomorPacking);
});

var i=0;
$('#add_new').click(function(){
  addRowPacking();
  i++;
  $('.nama').select2({
    theme: "bootstrap"
  });
});

</script>
@endpush
