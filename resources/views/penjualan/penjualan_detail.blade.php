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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nomor Nota</label>
                                <input type="text" class="form-control" name="nomor" id="nomor" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Customer</label> 
                                <input type="text" class="form-control" name="customer" id="customer" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Timbangan</label>
                                <input type="text" class="form-control" name="timbangan" id="timbangan" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Jatuh Tempo</label>
                                <input type="date" class="form-control" name="due_date" id="due_date" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Status Pelunasan</label>
                                <input type="text" class="form-control" name="status" id="status" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30"
                                    rows="1"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <div class="border" style="height:125px">
                                    <a href="" name="link" id="link" target="_blank" onclick="return !window.open(this.href, 'somesite', 'width=700,height=700')"><img src="" name="showfoto" id="showfoto" class="img-thumbnail" style="height:140px"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="tableDetail">
                            <thead class="thead-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="30%">Nama Aluminium</th>
                                    <th width="10%">Colly</th>
                                    <th width="10%">Isi</th>
                                    <th width="10%">Qty</th>
                                    <th width="10%">Harga</th>
                                    <th width="15%">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="mainbody">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>Total Nota</td>
                                    <td><input type="text" step="any" class="form-control" name="total_nota" id="total_nota" readonly></td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>Diskon</td>
                                    <td><input type="text" step="any" class="form-control" name="diskon_rupiah" id="diskon_rupiah" readonly></td>
                                </tr>
                                <tr>
                                    <td colspan="5"></td>
                                    <td>Total Akhir</td>
                                    <td><input type="text" step="any" class="form-control" name="total_akhir" id="total_akhir" readonly></td>
                                </tr>
                            </tfoot>
                            
                        </table>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Batal</button>
                    <a href="" target="_blank" class="btn btn-secondary" id="cetaksj" onclick="return !window.open(this.href, 'somesite', 'width=900,height=700')">Cetak SJ</a>
                    <a href="" target="_blank" class="btn btn-secondary" id="cetaknota" onclick="return !window.open(this.href, 'somesite', 'width=900,height=700')">Cetak Nota</a>
                    <button type="button" name="payment" id="payment" class="btn btn-success" data-toggle="modal" onclick="addPayment('{{ route('penjualan_aluminium.payment') }}')">Pembayaran</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@includeIf('penjualan.penjualan_payment')

@push('scripts')
<script>
</script>
@endpush
