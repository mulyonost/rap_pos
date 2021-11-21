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
                  <table class="table-bordered" width="100%" id="detail_table">
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

$(function() {
  $('#modal-form').on("keyup change blur shown.bs.modal", recalcProduksi);
});

$(function(){
  $('#tanggal').on("change", getNomorProduksi);
});

$('#add_new').click(function(){
  addRowProduksi();
  i++;
  $('.nama').select2({
    theme: "bootstrap"
  });
});

</script>
@endpush