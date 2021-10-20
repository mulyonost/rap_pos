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
                        <label for="nama" class="col-md-2 col-md-offset-1 control-label">Nama</label>                     
                      <div class="col-md-5">
                          <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="kategori" class="col-md-2 col-md-offset-1 control-label">Kategori</label>
                      <div class="col-md-5">
                          <input type="text" name="kategori" id="kategori" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="stok_awal" class="col-md-2 col-md-offset-1 control-label">Stok Awal</label>
                      <div class="col-md-5">
                          <input type="text" name="stok_awal" id="stok_awal" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="stok_minimum" class="col-md-2 col-md-offset-1 control-label">Stok Minimum</label>
                      <div class="col-md-5">
                          <input type="text" name="stok_minimum" id="stok_minimum" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="harga_beli" class="col-md-2 col-md-offset-1 control-label">Harga</label>
                      <div class="col-md-5">
                          <input type="text" name="harga_beli" id="harga_beli" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="foto" class="col-md-2 col-md-offset-1 control-label">Foto</label>
                      <div class="col-md-5">
                          <input type="text" name="foto" id="foto" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="keterangan" class="col-md-2 col-md-offset-1 control-label">Keterangan</label>
                      <div class="col-md-5">
                          <input type="text" name="keterangan" id="keterangan" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
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