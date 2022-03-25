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
                  <div class="form-group row">
                        <label for="nama" class="col-md-2 col-md-offset-1 control-label">Nama</label>                     
                      <div class="col-md-5">
                          <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="unit" class="col-md-2 col-md-offset-1 control-label">Unit</label>
                      <div class="col-md-5">
                          <select name="unit" id="unit" class="form-control">
                              <option value="" disabled selected>Pilih Unit</option>
                              <option value="kg">Kg</option>
                              <option value="liter">Liter</option>
                              <option value="pcs">Pcs</option>
                              <option value="cm">CM</option>
                              <option value="m">M</option>
                              <option value="tabung">Tabung</option>
                              <option value="jrg">Jerigen</option>
                              <option value="drum">Drum</option>
                              <option value="btg">Batang</option>
                              <option value="lbr">Lembar</option>
                              <option value="set">Set</option>
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="kategori" class="col-md-2 col-md-offset-1 control-label">Kategori</label>
                      <div class="col-md-5">
                          <select name="kategori" id="kategori" class="form-control">
                              <option value="" disabled selected>Pilih Kategori</option>
                              <option value="matras">Matras</option>
                              <option value="peleburan">Peleburan</option>
                              <option value="bahan_kimia">Packing</option>
                              <option value="bahan_kimia">Bahan Kimia</option>
                              <option value="spare_part">Spare Part</option>
                              <option value="perbaikan_pabrik">Tools/Mesin</option>
                              <option value="perbaikan_pabrik">Perbaikan Pabrik</option>
                              <option value="ongkir">Ongkos Kirim</option>
                              <option value="lain_lain">Lain Lain</option>
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="stok_awal" class="col-md-2 col-md-offset-1 control-label">Stok Awal</label>
                      <div class="col-md-5">
                          <input type="number" name="stok_awal" id="stok_awal" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="stok_minimum" class="col-md-2 col-md-offset-1 control-label">Stok Minimum</label>
                      <div class="col-md-5">
                          <input type="number" name="stok_minimum" id="stok_minimum" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="stok_sekarang" class="col-md-2 col-md-offset-1 control-label">Stok Sekarang</label>
                      <div class="col-md-5">
                          <input type="number" name="stok_sekarang" id="stok_sekarang" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="harga" class="col-md-2 col-md-offset-1 control-label">Harga</label>
                      <div class="col-md-5">
                          <input type="number" step="0.01" name="harga" id="harga" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="foto" class="col-md-2 col-md-offset-1 control-label">Foto</label>
                      <div class="col-md-5">
                          <input type="file" name="foto" id="foto" class="form-control">
                          <a href="" name="link" id="link" target="_blank"><img src="" name="showfoto" id="showfoto" class="img-thumbnail"></a>
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