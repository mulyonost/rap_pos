<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-lg">
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
                        <label for="nama" class="col-md-2 col-md-offset-1 control-label">Nama</label>                     
                      <div class="col-md-5">
                          <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="alamat" class="col-md-2 col-md-offset-1 control-label">Alamat</label>
                      <div class="col-md-5">
                          <input type="text" name="alamat" id="alamat" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="nama_kontak" class="col-md-2 col-md-offset-1 control-label"> Nama Kontak</label>
                      <div class="col-md-5">
                          <input type="text" name="nama_kontak" id="nama_kontak" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="kontak" class="col-md-2 col-md-offset-1 control-label"> Nomor Kontak</label>
                      <div class="col-md-5">
                          <input type="text" name="kontak" id="kontak" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="keterangan" class="col-md-2 col-md-offset-1 control-label">Keterangan</label>
                      <div class="col-md-5">
                          <textarea type="text" name="keterangan" id="keterangan" class="form-control"></textarea>
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