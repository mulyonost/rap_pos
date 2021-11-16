@extends('layouts.master')

@section('title')
    Pembelian Bahan Baku
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pembelian Bahan Baku</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border mb-2">
                <button onclick="addForm('{{ route('pembelian_bahan.store') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i>Pembelian Baru</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Nama Supplier</th>
                        <th>Total Nota</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th widht="5%"><i class="fa fa-cog"></i>Aksi</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@includeIf('pembelian.pembelian_form')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            buttons: [
                'excel', 'pdf'
            ],
            processing: true,
            autowidth: true,
            ajax: {
                url: '{{ route('pembelian_bahan.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable:false, sortable:false},
                {data: 'nomor'},
                {data: 'tanggal'},
                {data: 'supplier.nama'},
                {data: 'total', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp') },
                {data: 'due_date'},
                {data: 'status'},
                {data: 'aksi', searchable:false, sortable:false}
            ]
        });
        $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.ajax({
                    url: $('#modal-form form').attr('action'),
                    type: 'post',
                    data: $('#modal-form form').serialize(),
                })
                .done((response) => {
                    $('#modal-form').modal('hide');
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                    return;
                })
            }
        })

    });

    var date = $('#tanggal').val();
        var newDate = date.replace(/-/g, "");
        let r = (Math.random() + 1).toString(36).substring(7, 11).toUpperCase();
        var nomor = "RAP-" + newDate + "-" + r;



    function addForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Input Penjualan');
        $('#modal-form form')[0].reset();
        $('#nomor').val(nomor);
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nomor]').focus();
    }

    function add_row_sale(){
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
        }

    function editForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Penjualan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();

        $.get(url)
            .done((response) => {
                $('#mainbody').empty();
                $('#modal-form [name=nomor]').val(response.penjualan.nomor);
                $('#modal-form [name=tanggal]').val(response.penjualan.tanggal);
                $('#modal-form [name=customer]').val(response.penjualan.id_customer);
                $('#modal-form [name=due_date]').val(response.penjualan.due_date);
                $('#modal-form [name=foto_mobil]').val(response.foto_mobil);
                $('#modal-form [name=foto_barang]').val(response.foto_barang);
                $('#modal-form [name=timbangan]').val(response.penjualan.timbangan_mobil);
                $('#modal-form [name=status]').val(response.status);
                $('#modal-form [name=keterangan]').val(response.keterangan);
                for (i=0; i<response.penjualandetail.length; i++){
                    console.log(response.penjualandetail[i].colly);
                    add_row_sale();
                    $('#nama'+i+'').val(response.penjualandetail[i].id_aluminium);
                    $('#colly'+i+'').val(response.penjualandetail[i].colly);
                    $('#isi'+i+'').val(response.penjualandetail[i].isi);
                    $('#qty'+i+'').val(response.penjualandetail[i].qty);
                    $('#harga'+i+'').val(response.penjualandetail[i].harga);
                    $('#subtotal'+i+'').val(response.penjualandetail[i].subtotal);
                }
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });

    }

    function deleteData(url){
        if (confirm('Yakin akan menghapus data ?')) {
            $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'delete'
        })
        .done((response) => {
            table.ajax.reload();
        })
        .fail((errors) => {
            alert('Tidak dapat menghapus data');
            return;
        })
        }
    }
    
</script>
@endpush