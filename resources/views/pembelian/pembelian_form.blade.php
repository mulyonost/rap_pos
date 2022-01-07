<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-xl">
        <form action="" method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
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
                                <label for="">Supplier</label>
                                <select class="form-control nama" name="supplier" id="supplier" required>
                                            <option disabled="disabled" selected="selected" >Pilih Supplier</option>
                                        @foreach ($supplier as $supp)
                                            <option value="{{$supp->id}}">{{$supp->nama}}</option>
                                        @endforeach
                                        </select>    
                                        <input class="form-control" type="hidden" name="nama_supp" id="nama_supp">  
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Jatuh Tempo</label>
                                <input type="date" class="form-control" name="due_date" id="due_date" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Foto Nota</label>
                                <input type="file" class="form-control" name="foto_nota" id="foto_nota" value="">
                            </div>
                        </div>
                        <div class="col-md-4">
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
                    <div class="table-responsive center">
                        <table class="table-hover center" width="80%" id="table">
                            <thead>
                                <tr>
                                    <th width="">Nama Item</th>
                                    <th width="10%">Qty</th>
                                    <th width="10%">Harga</th>
                                    <th width="20%">Subtotal</th>
                                    <th><button id="add_new" type="button" name="add_new"
                                            class="btn btn-sm btn-success"> +</button></th>
                                </tr>
                            </thead>
                            <tbody id="mainbody">

                            <tfoot>
                                <tr>
                                    <td></td>
                                </td>
                                <td>Total Nota</td>
                                <td colspan="2"><input type="number" class="form-control" name="total_nota" id="total_nota" readonly>
                                <td></td>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Batal</button>
                    <button type="button" name="payment" id="payment" class="btn btn-default" data-toggle="modal" onclick="addPayment('{{ route('pembelian_bahan.payment') }}')">Pembayaran</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@includeIf('pembelian.pembelian_payment')

@push('scripts')
<script>

    $(function() {
        $('#modal-form').on("keyup change blur", recalcPembelian);
    });

    $(function() {
        $('#tanggal').on("change", getNomorPembelianBahan);
    });

    var i = 0;
    $('#add_new').click(function() {
        i++;
        addRowPembelian();
    });

    function getSupplier() {
        let supplier = $('#supplier option:selected').text();
        $('#nama_supp').val(supplier);
    }

    $(function() {
        $('#supplier').on("change click", getSupplier);
    });

</script>
@endpush
