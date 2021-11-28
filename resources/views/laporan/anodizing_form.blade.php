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
                        <label for="">Total Kg</label>
                        <input type="number" class="form-control form-control-sm col-md-6" name="total_kg" id="total_kg" readonly>
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
                          <th width="10%">Qty</th>
                          <th width="10%">Berat</th>
                          <th>Subtotal KG</th>
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

$(function() {
  $('#modal-form').on("keyup change blur shown.bs.modal", recalcAnodizing)
});

$(function(){
  $('#tanggal').on("change", getNomorAnodizing)
});

var i=0;
$('#add_new').click(function(){
  addRowAnodizing();
  i++;
  $('.nama').select2({
    theme: "bootstrap-5"
  });
});

</script>
@endpush
