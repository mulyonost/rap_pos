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
                                <label for="">Supplier</label>
                                <select class="form-control nama" name="supplier" id="supplier" required>
                                            <option disabled="disabled" selected="selected" >Pilih Supplier</option>
                                        @foreach ($supplier as $supp)
                                            <option value="{{$supp->id}}">{{$supp->nama}}</option>
                                        @endforeach
                                        </select> 
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive center">
                        <table class="table-hover center" width="50%" id="table">
                            <thead>
                                <tr>
                                    <th width="">Nama Avalan</th>
                                    <th width="40%">Harga</th>
                                    <th><button id="add_new" type="button" name="add_new"
                                            class="btn btn-sm btn-success"> +</button></th>
                                </tr>
                            </thead>
                            <tbody id="mainbody">
                                <tr>
                                    <td><select class="form-control nama" name="addmore[0][nama]" id="nama0" required>
                                        <option value="">Pilih Barang</option>
                                        @foreach ($avalan as $bahan)
                                            <option value="{{$bahan->id}}">{{$bahan->nama}}</option>
                                        @endforeach
                                        </select>                                        
                                    </td>
                                    <td><input class="form-control harga" type="number" name="addmore[0][harga]" id="harga0" required></td>
                                    <td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> - </button></td>
                                </tr>
                            </tbody>
                        </table>
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
        '<select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" required>' +
            '<option value="">Pilih Barang</option>' +
            '@foreach ($avalan as $alma)' +
            '<option value="{{$alma->id}}">{{$alma->nama}}</option>' +
            '@endforeach' +
        '</select></td>' +
        '<td><input class="form-control harga" type="number" name="addmore['+i+'][harga]" id="harga'+i+'" required></td>' +
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
