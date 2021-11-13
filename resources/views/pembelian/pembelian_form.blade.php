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
                                <tr>
                                    <td><select class="form-control nama" name="addmore[0][nama]" id="nama0" required>
                                        <option value="">Pilih Barang</option>
                                        @foreach ($item as $bahan)
                                            <option value="{{$bahan->id}}">{{$bahan->nama}}</option>
                                        @endforeach
                                        </select>                                        
                                    </td>
                                    <td><input class="form-control qty" type="number" name="addmore[0][qty]" id="qty0" required></td>
                                    <td><input class="form-control harga" type="number" name="addmore[0][harga]" id="harga0" required></td>
                                    <td><input class="form-control subtotal" type="number" name="addmore[0][subtotal]" id="subtotal0" readonly></td>
                                    <td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> - </button></td>
                                </tr>
                            <tfoot>
                                <tr>
                                    <td></td>
                                </td>
                                <td>Total Nota</td>
                                <td colspan="2"><input type="number" step="any" class="form-control" name="total_nota" id="total_nota" readonly>
                                <td></td>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Batal</button>
                    <a href="{{ route('sale.cetaksj') }}" target="_blank" class="btn btn-default">Cetak SJ</a>
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
        let colly = 0;
        let isi = 0;
        let qty = 0;
        let harga = 0;
        let subtotal = 0;
        let totalNota = 0;
        let diskonPersen = $('#diskon_persen').val();
        let diskonRupiah = 0;
        let totalAkhir = 0;
        $('#table').find('tr').each(function() {
            let colly = $(this).find('input.colly').val();
            let isi = $(this).find('input.isi').val();
            let harga = $(this).find('input.harga').val();
            let qty = (colly * isi);
            let subtotal = (qty * harga);
            $(this).find('input.qty').val(Math.round(qty * 100) / 100);
            $(this).find('input.subtotal').val(subtotal);
            totalNota += subtotal ? subtotal : 0;
        });
        diskonRupiah = diskonPersen/100 * totalNota;
        totalAkhir = totalNota - diskonRupiah;
        $('#total_nota').val(totalNota);
        $('#diskon_rupiah').val(diskonRupiah);
        $('#total_akhir').val(totalAkhir);
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
        '<select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" required>' +
            '<option value="">Pilih Barang</option>' +
            '@foreach ($item as $alma)' +
            '<option value="{{$alma->id}}">{{$alma->nama}}</option>' +
            '@endforeach' +
        '</select></td>' +
        '<td><input class="form-control colly" type="number" name="addmore['+i+'][colly]" id="colly'+i+'" required></td>' +
        '<td><input class="form-control isi" type="number" name="addmore['+i+'][isi]" id="isi'+i+'" required></td>' +
        '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required></td>' +
        '<td><input class="form-control harga" type="number" name="addmore['+i+'][harga]" id="harga'+i+'" required></td>' +
        '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" readonly></td>' +
        '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> - </button></td>'
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
