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
                                            <input class="form-control" type="text" name="nomor" id="nomor">
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
                                <div class="form-group"><label>Keterangan</label></div><textarea class="form-control" style="height: 125px;min-height: 0px;margin-top: -16px;" name="keterangan" id="keterangan"></textarea></div>
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
                                            <tr>
                                                <td><select class="form-control" id="item0" name="addmore[0][item]">
                                                    <option value="" selected="" disabled>Pilih Item</option>
                                                    @foreach ($avalan as $bahan)
                                                    <option value="{{ $bahan->id }}">{{ $bahan->nama }}</option>
                                                    @endforeach
                                                </select></td>
                                                <td><input class="form-control qty" type="number" step="0.01" id="qty0" name="addmore[0][qty]"></td>
                                                <td><input class="form-control potongan" type="number" step="0.01" id="potongan0" name="addmore[0][potongan]" value=0></td>
                                                <td><input class="form-control qty_akhir" type="number" step="0.01" id="qty_akhir0" name="addmore[0][qty_akhir]" readonly tabindex="-1"></td>
                                                <td><input class="form-control harga" type="number" id="harga0" name="addmore[0][harga]"></td>
                                                <td><input class="form-control subtotal" type="number" id="subtotal0" name="addmore[0][subtotal]" readonly></td>
                                                <td><button id="remove_row" type="button" name="remove_row" class="ml-5 btn btn-sm btn-danger remove"> -</button></td>
                                            </tr>
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
                    <button type="button" class="btn btn-default" disabled></i>Pembayaran</button>
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
        $('#table-detail').find('tr').each(function() {
            let qty = $(this).find('input.qty').val();
            let potongan = $(this).find('input.potongan').val()
            let harga = $(this).find('input.harga').val();
            let qty_akhir = qty - potongan;
            let subtotal = (qty_akhir * harga);
            $(this).find('input.qty_akhir').val(qty_akhir);
            $(this).find('input.subtotal').val(subtotal);
            totalNota += subtotal ? subtotal : 0;
        });
        $('.total_nota').val(totalNota);
    }

    function getdate() {
        var date = $('#tanggal').val();
        var newDate = date.replace(/-/g, "");
        let r = (Math.random() + 1).toString(36).substring(7, 11).toUpperCase();
        var nomor = "PA-" + newDate + "-" + r;
        $('#nomor').val(nomor);
    }

    function getJT() {
        var date = $('#tanggal').val();
        $('#due_date').val(date);
    }

    $(function() {
        $('#modal-form').on("keyup change blur", recalc);
    });

    $(function() {
        $('#tanggal').on("change", getdate);
        $('#tanggal').on("change", getJT);
    });

    var i = 0;
    $('#add_new').click(function() {
        i++;
        $('#mainbody').append(
            '<tr>' +
               '<td><select class="form-control" id="item' + i + '" name="addmore[' + i + '][item]">' +
                    '<option value="" selected="" disabled>Pilih Item</option>' +
                    '@foreach ($avalan as $bahan)' +
                    '<option value="{{ $bahan->id }}">{{ $bahan->nama }}</option>' +
                    '@endforeach' +
                '</select></td>' +
                '<td><input class="form-control qty" type="number" step="0.01" id="qty'+ i +'" name="addmore['+ i +'][qty]"></td>' +
                '<td><input class="form-control potongan" type="number" step="0.01" id="potongan'+ i +'" name="addmore['+ i +'][potongan]"></td>' +
                '<td><input class="form-control qty_akhir" type="number" step="0.01" id="qty_akhir'+ i +'" name="addmore['+ i +'][qty_akhir]" readonly tabindex="-1"></td>' +
                '<td><input class="form-control harga" type="number" id="harga'+ i +'" name="addmore['+ i +'][harga]"></td>' +
                '<td><input class="form-control subtotal" type="number" id="subtotal'+ i +'" name="addmore['+ i +'][subtotal]" readonly></td>' +
                '<td><button id="remove_row" type="button" name="remove_row" class="ml-5 btn btn-sm btn-danger remove"> -</button></td>' +
            '</tr>' 
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

    function getSupplier() {
        let supplier = $('#supplier option:selected').text();
        $('#nama_supp').val(supplier);
    }


    $(function() {
        $('#supplier').on("change click", getSupplier);
    });
    

</script>
@endpush
