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
                    <div class="container" style="margin-top: 20px;">
                        <div class="form-row">
                            <div class="col">
                                <h1 style="font-size: 20px;">General Information</h1>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 10px;">
                            <div class="col">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label>Nomor Pengambilan Bahan</label><input class="form-control" type="text" name="nomor" id="nomor"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label style="margin-bottom: 0px;">Tanggal</label></div><input class="form-control" type="date" style="margin-top: -8px;" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label>Divisi</label>
                                            <select class="form-control" name="divisi" id="divisi">
                                                <option value="" selected="" disabled>Pilih Divisi</option>
                                                <option value="peleburan">Peleburan</option>
                                                <option value="produksi">Produksi</option>
                                                <option value="anodizing">Anodizing</option>
                                                <option value="packing">Packing</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group"><label>Foto Berkas</label><input type="file"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group"><label>Keterangan</label></div><textarea class="form-control" style="height: 125px;min-height: 0px;margin-top: -16px;"></textarea></div>
                        </div>
                        <div class="form-row" style="margin-top: 42px;">
                            <h1 style="font-size: 20px;">Detail Bahan&nbsp;</h1>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="table-responsive border rounded-0">
                                    <table class="table-detail table-striped">
                                        <thead class="bg-white">
                                            <tr>
                                                <th width="70%" class="text-center" colspan="2" style="border-style: none;">Nama Barang</th>
                                                <th width="20%" class="text-center" colspan="2" style="border-style: none;">Qty</th>
                                                <th width="10%"><button id="add_new" type="button" name="add_new" class="ml-5 btn btn-sm btn-success"> +</button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="mainbody">
                                            <tr>
                                                <td>Gambar <br>nanti disini</td>
                                                <td><select class="form-control" id="item0" name="addmore[0][item]">
                                                    <option value="" selected="" disabled>Pilih Item</option>
                                                    @foreach ($avalan as $bahan)
                                                    <option value="{{ $bahan->id }}">{{ $bahan->nama }}</option>
                                                    @endforeach
                                                </select></td>
                                                <td><input class="form-control" type="number" step="0.01" id="qty0" name="addmore[0][qty]"></td>
                                                <td id="satuan" name="satuan">Ltr</td>
                                                <td><button id="remove_row" type="button" name="remove_row" class="ml-5 btn btn-sm btn-danger remove"> -</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Batal</button>
                    <a href="" target="_blank" class="btn btn-default">Cetak SJ</a>
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
    var numRows = 2, ti = 5;

    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function recalc() {
        let qty = 0;
        let harga = 0;
        let subtotal = 0;
        let totalNota = 0;
        $('#table').find('tr').each(function() {
            let qty = $(this).find('input.qty').val();
            let harga = $(this).find('input.harga').val();
            let subtotal = (qty * harga);
            $(this).find('input.subtotal').val(subtotal);
            totalNota += subtotal ? subtotal : 0;
        });
        $('#total_nota').val(totalNota);
    }

    function getdate() {
        var date = $('#tanggal').val();
        var newDate = date.replace(/-/g, "");
        let r = (Math.random() + 1).toString(36).substring(7, 11).toUpperCase();
        var nomor = "RAP-" + newDate + "-" + r;
        $('#nomor').val(nomor);
    }

    $(function() {
        $('#modal-form').on("keyup change blur", recalc);
    });

    $(function() {
        $('#tanggal').on("change", getdate);
    });

    var i = 0;
    $('#add_new').click(function() {
        i++;
        $('#mainbody').append('<tr><td>' +
            'Gambar <br>nanti disini</td>' +
            '<td><select class="form-control" id="item[' + i + ']" name="addmore['+ i +'][item]">' +
            '<option value="" selected="" disabled>Pilih Item</option>' +
                    '@foreach ($avalan as $bahan)' +
                    '<option value="{{ $bahan->id }}">{{ $bahan->nama }}</option>' +
                    '@endforeach' +
                '</select></td>' +
                '<td><input class="form-control" type="number" step="0.01" id="qty'+ i +'" name="addmore['+ i +'][qty]"></td>' +
                '<td id="satuan" name="satuan">Ltr</td>' +
                '<td><button id="remove_row" type="button" name="remove_row" class="ml-5 btn btn-sm btn-danger remove"> -</button></td></tr>'
            )
            $('.nama').select2({
                theme: "bootstrap"
            });
    });

    $(document).on('click', '.remove', function(event) {
        jQuery(this).parent().parent().remove();
        return false;
    });

    $(document).ready(function () {
        $('.nama').select2({
        theme: "bootstrap"
        })
    });

    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    $('.nama').select2({
        theme: "bootstrap"
    });

</script>
@endpush
