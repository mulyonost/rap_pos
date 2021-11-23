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
                    <div class="container">
                        <div class="form-row">
                            <div class="col">
                                <h1 style="font-size: 20px;">General Information</h1>
                            </div>
                        </div>
                        <div class="form-row mt-3" >
                            <div class="col">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nomor Pembelian Avalan</label>
                                            <input class="form-control" type="text" name="nomor" id="nomor" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input class="form-control" type="date" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <select name="supplier" id="supplier" class="form-control">
                                                <option value="" disabled selected="">Pilih Supplier</option>
                                                @foreach ($supplier as $supp)
                                                <option value="{{ $supp->id }}">{{ $supp->nama }}</option>
                                                @endforeach
                                            </select>
                                            <input class="form-control" type="hidden" name="nama_supp" id="nama_supp">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Jatuh Tempo</label>
                                            <input class="form-control" type="date" name="due_date" id="due_date" value="<?= date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label>Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="0" selected >Belum Lunas</option>
                                                <option value="1">Lunas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label>Foto Berkas</label>
                                        <input type="file" class="form-group" name="foto" id="foto"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Keterangan</label></div><textarea class="form-control" style="height: 125px;min-height: 0px;margin-top: -16px;" name="keterangan" id="keterangan"></textarea>
                                </div>
                            </div>
                        <div class="form-row" style="margin-top: 42px;">
                            <h1 style="font-size: 20px;">Detail Avalan&nbsp;</h1>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="table-responsive border rounded-0">
                                    <table class="table-detail table-striped" name="table-detail" id="table-detail">
                                        <thead class="bg-white">
                                            <tr>
                                                <th width="40%" class="text-center" style="border-style: none;">Nama Barang</th>
                                                <th width="10%" class="text-center" style="border-style: none;">Qty</th>
                                                <th width="10%" class="text-center" style="border-style: none;">Potongan</th>
                                                <th width="10%" class="text-center" style="border-style: none;">Qty Akhir</th>
                                                <th width="10%" class="text-center" style="border-style: none;">Harga</th>
                                                <th width="10%" class="text-center" style="border-style: none;">Subtotal</th>
                                                <th width="10%"><button id="add_new" type="button" name="add_new" class="ml-5 btn btn-sm btn-success"> +</button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="mainbody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-md-2 offset-md-2">
                                <label for="">Total Nota</label>
                            </div>
                            <div class="col-md-2 offset-md-1">
                                <input type="number" name="total" class="form-control total_nota" readonly>
                            </div>
                            <div class="offset-md-1">
                            </div>
                        </div>
                    </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Batal</button>
                    <button type="button" onclick="addPayment()" class="btn btn-default">Pembayaran</button>
                    <a href="" target="_blank" class="btn btn-default">Cetak Nota</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@includeif('pembelian.pembelian_avalan_payment');
@push('scripts')
<script>

    $(function() {
        $('#modal-form').on("keyup change blur", recalcPembelianAvalan);
    });

    $(function() {
        $('#tanggal').on("change", getNomorPembelianAvalan);
        $('#tanggal').on("change", getPembelianAvalanJT);
    });

    var i = 0;
    $('#add_new').click(function(){
        addPembelianAvalanRow();
        i++;
        $('.nama').select2({
            theme: "bootstrap"
        });
    });

    function getSupplier() {
        let supplier = $('#supplier option:selected').text();
        $('#nama_supp').val(supplier);
    }


    $(function() {
        $('#supplier').on("change click", getSupplier);
    });

    function addPayment(){
        $('#modal-form-payment').modal('show');
        $('#modal-form-payment .modal-title').text('Pembayaran Avalan');
        // $('#modal-form form')[0].reset();
        // $('#modal-form [name=_method]').val('post');
        // $('#modal-form [name=nomor]').focus();
    }
    

</script>
@endpush
