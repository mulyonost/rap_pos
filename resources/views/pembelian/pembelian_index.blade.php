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
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
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
                {
                extend : 'copyHtml5',
                exportOptions : {orthogonal : 'export'}
                }
            ],
            processing: true,
            dom: 'Bfrtip',
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
                {data: 'status',
                    render : function (data, type, row) {
                        if (row.status === 0) {
                            return '<p class= "text-danger"> Belum Lunas </p>';
                        }
                        else {
                            return '<p class= "text-success"> Lunas </p>';
                    }
                    }
                },
                {data: 'aksi', searchable:false, sortable:false}
            ],
            footerCallback: function( tfoot, data, start, end, display ) {
                var api = this.api(), data;
                var numFormat = $.fn.dataTable.render.number('.', ',', 0, 'Rp').display;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
    
                // Total over all pages
                total = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
 
                $( api.column( 4 ).footer() ).html(
                    numFormat(pageTotal) +' ('+ numFormat(total) +' total)'
                );
            }
        });
        showData();
        $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                let formData = new FormData(this);
                $.ajax({
                    url: $('#modal-form form').attr('action'),
                    type: 'post',
                    contentType: false,
                    processData: false,
                    data: formData,
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

    function addForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Input Pembelian');
        $('#modal-form form')[0].reset();
        $('#mainbody').empty();
        addRowPembelian();
        getNomorPembelianBahan();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nomor]').focus();
    }

    function addRowPembelian(){
        $('#mainbody').append('<tr><td>' +
        '<select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" required>' +
            '<option value="">Pilih Barang</option>' +
            '@foreach ($item as $alma)' +
            '<option value="{{$alma->id}}">{{$alma->nama}}</option>' +
            '@endforeach' +
        '</select></td>' +
        '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required></td>' +
        '<td><input class="form-control harga" type="number" step="0.01" name="addmore['+i+'][harga]" id="harga'+i+'" required></td>' +
        '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" readonly></td>' +
        '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> - </button></td>'
        )
    }

    function editForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Pembelian Bahan');
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();

        $.get(url)
            .done((response) => {
                $('#mainbody').empty();
                console.log(response);
                $('#modal-form [name=nomor]').val(response.pembelian.nomor);
                $('#modal-form [name=tanggal]').val(response.pembelian.tanggal);
                $('#modal-form [name=supplier]').val(response.pembelian.id_supplier);
                $('#modal-form [name=due_date]').val(response.pembelian.due_date);
                $('#modal-form [name=status]').val(response.pembelian.status);
                $('#modal-form [name=keterangan]').val(response.pembelian.keterangan);
                var url = "{{ route('pembelian_bahan.paymentDelete', '')}}" + "/" + response.pembelian.id;
                $('#modal-form-payment [id=hapus]').attr("href", url);
                $('#modal-form-payment [name=id_pembelian]').val(response.pembelian.id);
                for (i=0; i<response.pembeliandetail.length; i++){
                    addRowPembelian();
                    $('#nama'+i+'').val(response.pembeliandetail[i].id_item);
                    $('#qty'+i+'').val(response.pembeliandetail[i].qty);
                    $('#harga'+i+'').val(response.pembeliandetail[i].harga);
                }
                recalcPembelian();
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
    
    function addPayment(url){
        $('#modal-form-payment').modal('show');
        $('#modal-form-payment .modal-title').text('Pembayaran Bahan');
        $('#modal-form-payment form').attr('action', url);
        $('#modal-form-payment [name=_method]').val('post');
    }
</script>
@endpush