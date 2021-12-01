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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nomor Nota</label>
                                <input type="text" class="form-control" name="nomor" id="nomor" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Customer</label>
                                <select class="form-control nama" name="customer" id="customer" required>
                                            <option disabled="disabled" selected="selected" >Pilih Supplier</option>
                                        @foreach ($customer as $customer)
                                            <option value="{{$customer->id}}">{{$customer->nama}}</option>
                                        @endforeach
                                        </select>      
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Jatuh Tempo</label>
                                <input type="date" class="form-control" name="due_date" id="due_date" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Foto Mobil</label>
                                <input type="file" class="form-control" name="foto_mobil" id="foto_mobil" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Foto Nota</label>
                                <input type="file" class="form-control" name="foto_nota" id="foto_nota" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Timbangan</label>
                                <input type="text" class="form-control" name="timbangan" id="timbangan" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Status Pelunasan</label>
                                <select class="form-control"  name="status" id="status">
                                    <option value="0">Belum Lunas</option>
                                    <option value="1">Lunas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table-hover" width="100%" id="table">
                            <thead>
                                <tr>
                                    <th width="40%">Nama Aluminium</th>
                                    <th width="10%">Colly</th>
                                    <th width="10%">Isi</th>
                                    <th width="10%">Qty</th>
                                    <th width="10%">Harga</th>
                                    <th>Subtotal</th>
                                    <th><button id="add_new" type="button" name="add_new"
                                            class="btn btn-sm btn-success"> +</button></th>
                                </tr>
                            </thead>
                            <tbody id="mainbody">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Nota</td>
                                    <td colspan="2"><input type="number" step="any" class="form-control" name="total_nota" id="total_nota" readonly>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Diskon</td>
                                    <td><input type="number" step="any" class="form-control" name="diskon_persen" id="diskon_persen"></td>
                                    <td><input type="number" step="any" class="form-control" name="diskon_rupiah" id="diskon_rupiah" readonly></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Akhir</td>
                                    <td colspan="2"><input type="number" step="any" class="form-control" name="total_akhir" id="total_akhir" readonly>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            
                        </table>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Batal</button>
                    <a href="{{ route('penjualan_aluminium.cetaksj') }}" target="_blank" class="btn btn-default">Cetak SJ</a>
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
        $('#modal-form').on("keyup change blur", recalcPenjualan);
    });


    $(function() {
        $('#tanggal').on("change", getNomorPenjualan);
    });

    var i = 0;
    $('#add_new').click(function() {
        i++;
        addRowPenjualan();
        $('.nama').select2({
        theme: "bootstrap-5"
        })
    });


</script>
@endpush
