<style>
tr {
   line-height: 15px;
   min-height: 15px;
   height: 15px;
}
</style>

<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-xl">
        <form action="" method="post" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Pembelian Bahan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nomor Nota</label>
                                <input type="text" class="form-control" name="nomor" id="nomor" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Supplier</label>
                                <input type="text" class="form-control" name="supplier" id="supplier" readonly>
                                        <input class="form-control" type="hidden" name="nama_supp" id="nama_supp">  
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Jatuh Tempo</label>
                                <input type="date" class="form-control" name="due_date" id="due_date" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Status Pelunasan</label>
                                <input type="text" class="form-control" name="status" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30"
                                    rows="2" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Foto</label>
                            <div class="border" style="max-height:150px">
                                <a href="" name="link" id="link" target="_blank" onclick="return !window.open(this.href, 'somesite', 'width=700,height=700')"><img src="" name="showfoto" id="showfoto" class="img-thumbnail" style="height:140px"></a>
                            </div>
                        </div>
                    </div>

                    <div class="border border-secondary">
                        <table class="table table-sm table-bordered" width="99%" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th width="45%">Nama Item</th>
                                    <th width="15%">Qty</th>
                                    <th width="20%">Harga</th>
                                    <th width="20%">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="mainbody">

                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total Nota</td>
                                    <td><input type="text" class="form-control" name="total" id="total" readonly>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Batal</button>
                    <button type="button" name="payment" id="payment" class="btn btn-success" data-toggle="modal" onclick="addPayment('{{ route('pembelian_bahan.payment') }}')">Pembayaran</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@includeIf('pembelian.bahan.pembelian_payment')

@push('scripts')
<script>
</script>
@endpush
