<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-xl">
        <form action="javascript:;" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                        <label for="nama" class="col-md-2 col-md-offset-1 control-label">Base ALuminium</label>                     
                      <div class="col-md-5">
                          <select name="base" id="base" class="form-control">
                              @foreach ($base as $base)
                                <option value="{{ $base->id }}">{{ $base->nama }}</option>
                              @endforeach                              
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>                 
                  <div class="form-group row">
                        <label for="nama" class="col-md-2 col-md-offset-1 control-label">Nama</label>                     
                      <div class="col-md-5">
                          <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="finishing" class="col-md-2 col-md-offset-1 control-label">Finish/Warna</label>
                      <div class="col-md-5">
                      <select name="finishing" id="finishing" class="form-select form-control col-md-4" size="3" aria-label="size 3 select example">
                        <option value="MF">MF</option>
                        <option value="CA">CA</option>
                        <option value="BR">BR</option>
                      </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="kategori" class="col-md-2 col-md-offset-1 control-label"> Kategori</label>
                      <div class="col-md-5">
                        <select name="kategori" class="form-group form-control" aria-label="Default select example">
                            <option value="ALUMINIUM" selected>ALUMINIUM</option>
                            <option value="TANGGA">TANGGA</option>
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="berat_maksimal" class="col-md-2 col-md-offset-1 control-label"> Berat Max</label>
                      <div class="col-md-5">
                          <input type="text" name="berat_maksimal" id="berat_maksimal" class="form-control">
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
                      <label for="stok_minimum" class="col-md-2 col-md-offset-1 control-label">Stok Min</label>
                      <div class="col-md-5">
                          <input type="text" name="stok_minimum" id="stok_minimum" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="berat_jual" class="col-md-2 col-md-offset-1 control-label">Berat Jual</label>
                      <div class="col-md-5">
                          <input type="text" name="berat_jual" id="berat_jual" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="harga_jual" class="col-md-2 col-md-offset-1 control-label">Harga Jual</label>
                      <div class="col-md-5">
                          <input type="text" name="harga_jual" id="harga_jual" class="form-control">
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="foto" class="col-md-2 col-md-offset-1 control-label">Foto</label>
                      <div class="col-md-5">
                          <input class="form-control" type="file" name="foto" id="foto" >
                          <span class="help-block with-errors"></span>
                      </div>
                      <div class="col-md-5">
                          <img src="{{ asset('/uploads/aluminium/') }}" alt="">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="keterangan" class="col-md-2 col-md-offset-1 control-label">Keterangan</label>
                      <div class="col-md-5">
                          <textarea type="text" name="keterangan" id="keterangan" class="form-control"></textarea>
                          <span class="help-block with-errors"></span>
                      </div>
                  </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>

            </div>
              <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->