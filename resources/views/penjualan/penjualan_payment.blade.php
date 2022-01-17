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
                            <input type="hidden" name="id_penjualan">
                            <table class="table responsive" id="table-detail-payment">
                                <thead>
                                    <tr>
                                        <th>Bank</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th width="5%"><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                                    </tr>
                                </thead>
                                <tbody id="mainbody-payment">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><input type="text" class="form-control" name="sisa" id="sisa" readonly></td>
                                        <input type="hidden" id="sisa_awal">
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
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

var x = 0;
$('#add_new').click(function() {
    x++;
    addRowPayment();
});


$(function() {
    $('#modal-form-payment').on("keyup change blur onmouseover", hitungSisa);    
});

</script>
@endpush
