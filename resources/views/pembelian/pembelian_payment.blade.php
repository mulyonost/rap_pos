<div class="modal fade" id="modal-form-payment">
    <div class="modal-dialog modal-lg">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Nomor Nota</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="nomor" readonly>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label for="">Total Nota</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="total" readonly>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label for="tanggal">Tanggal Pembayaran</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control" type="date" id="tanggal_pembayaran" name="tanggal_pembayaran" value="<?= date('Y-m-d') ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-row">
                                    <label for="tanggal">Keterangan Pembayaran</label>
                                    <textarea class="form-control" type="text" id="keterangan_pembayaran" name="keterangan_pembayaran" rows="3"></textarea>
                                    <input type="hidden" class="form-control" type="text" id="id_pembelian" name="id_pembelian">
                                </div>
                            </div>
                        </div>


                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Nomor Nota</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" id="nomor" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Total Nota</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" id="total" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="form-group-row">
                                    <label class="form-control" for="tanggal">Tanggal Pembayaran</label>
                                    <input class="form-control" type="date" id="tanggal_pembayaran" name="tanggal_pembayaran" value="<?= date('Y-m-d') ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group-row">
                                    <label class="form-control" for="tanggal">Keterangan</label>
                                    <textarea class="form-control" type="text" id="keterangan_pembayaran" name="keterangan_pembayaran"></textarea>
                                    <input type="hidden" class="form-control" type="text" id="id_pembelian" name="id_pembelian">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
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


</script>
@endpush
