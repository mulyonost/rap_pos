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
                        <input type="text" name="id_penjualan" id="id_penjualan" value="{{ $penjualan->id }}">
                        <div class="row">
                            <table class="table responsive">
                                <thead>
                                    <tr>
                                        <th>Bank</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th width="5%"><button id="add_new" type="button" name="add_new" class="btn btn-sm btn-success"> +</button></th>
                                    </tr>
                                <thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control" name="bank" id="bank"></td>
                                        <td><input type="date" class="form-control" name="tanggal" id="tanggal"></td>
                                        <td><input type="text" class="form-control" name="jumlah" id="jumlah"></td>
                                        <td><input type="text" class="form-control" name="keterangan" id="keterangan"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><input type="text" class="form-control" name="sisa" id="sisa"></td>
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

function sisa(){
    let awal = 0;
    let total = 0;
    let jumlah = 0;
    let sisa = 0
    awal = $('#sisa').val();
    total = $('#sisa').val();
    jumlah = $('#jumlah').val()
    sisa = total - jumlah;
    $('#sisa').val(sisa);    
}

// $(function() {
//         $('#modal-form-payment').on("keyup change blur mouseenter", sisa);
//     });

</script>
@endpush
