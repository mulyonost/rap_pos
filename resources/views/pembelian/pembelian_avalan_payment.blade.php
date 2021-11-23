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
                        <div class="col">
                            <div class="form-group">
                                <label class="form-control" for="tanggal">Tanggal Pembayaran</label>
                                <input class="form-control" type="date" id="tanggal_pembayaran">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-control" for="tanggal">Keterangan</label>
                                <input class="form-control" type="text" id="keterangan_pembayaran">
                            </div>
                        </div>
                    </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Batal</button>
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


</script>
@endpush
