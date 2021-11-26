@extends('layouts.master')

@section('title')
    Pembelian Avalan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pembelian Avalan</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border mb-2">
                <button onclick="addForm('{{ route('pembelian_avalan.store') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i>Pembelian Baru</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>Total Nota</th>
                        <th>Jatuh Tempo</th>
                        <th>Tgl Pelunasan</th>
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
@includeIf('pembelian.pembelian_avalan_form')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            dom: 'Bfrtip',
            pageLength: 25,
            processing: true,
            autowidth: true,
            ajax: {
                url: '{{ route('pembelian_avalan.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable:false, sortable:false},
                {data: 'nomor'},
                {data: 'tanggal'},
                {data: 'supplier.nama'},
                {data: 'total_nota', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp')},
                {data: 'due_date'},
                {data: 'tanggal_bayar'},
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
            buttons: [
                {
                extend : 'copyHtml5',
                exportOptions : {orthogonal : 'export'}
                }
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
        $('#modal-form .modal-title').text('Pembelian Avalan');
        $('#modal-form [name=payment]').attr("disabled", "");
        $('#modal-form form')[0].reset();
        $('#mainbody').empty();
        $('#modal-form').ready(function() {
            addPembelianAvalanRow();
            i++;
            $('.nama').select2({
                theme: "bootstrap"
            });            
        });
        getNomorPembelianAvalan();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nomor]').focus();
    }

    function addPembelianAvalanRow(){
        $('#mainbody').append(
            '<tr>' +
               '<td><select class="form-control" id="item' + i + '" name="addmore[' + i + '][item]">' +
                    '<option value="" selected="" disabled>Pilih Item</option>' +
                    '@foreach ($avalan as $bahan)' +
                    '<option value="{{ $bahan->id }}">{{ $bahan->nama }}</option>' +
                    '@endforeach' +
                '</select></td>' +
                '<td><input class="form-control qty" type="number" step="0.01" id="qty'+ i +'" name="addmore['+ i +'][qty]"></td>' +
                '<td><input class="form-control potongan" type="number" step="0.01" id="potongan'+ i +'" name="addmore['+ i +'][potongan]" value=0></td>' +
                '<td><input class="form-control qty_akhir" type="number" step="0.01" id="qty_akhir'+ i +'" name="addmore['+ i +'][qty_akhir]" readonly tabindex="-1"></td>' +
                '<td><input class="form-control harga" type="number" id="harga'+ i +'" name="addmore['+ i +'][harga]" value=0></td>' +
                '<td><input class="form-control subtotal" type="number" id="subtotal'+ i +'" name="addmore['+ i +'][subtotal]" readonly></td>' +
                '<td><button id="remove_row" type="button" name="remove_row" class="ml-5 btn btn-sm btn-danger remove"> -</button></td>' +
            '</tr>' 
            )
        }

    function editForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Pembelian Avalan');
        $('#modal-form [name=payment]').attr("disabled", false);
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();

        $.get(url)
            .done((response) => {
                $('#mainbody').empty();
                console.log(response);
                $('#modal-form [name=nomor]').val(response.pembelianav.nomor);
                $('#modal-form [name=tanggal]').val(response.pembelianav.tanggal);
                $('#modal-form [name=supplier]').val(response.pembelianav.id_supplier);
                $('#modal-form [name=due_date]').val(response.pembelianav.due_date);
                $('#modal-form [name=status]').val(response.pembelianav.status);
                $('#modal-form [name=keterangan]').val(response.pembelianav.keterangan);
                var url = "{{ route('pembelian_avalan.cetakulang', '')}}" + "/" + response.pembelianav.id;
                $('#modal-form [id=cetak]').attr("href", url);
                $('#modal-form-payment [name=id_pembelian_avalan]').val(response.pembelianav.id);
                $('#modal-form-payment [name=tanggal]').val(response.pembelianav.tanggal_bayar);
                $('#modal-form-payment [name=status]').val(response.pembelianav.status);
                for (i=0; i<response.pembelianavdetail.length; i++){
                    console.log(response.pembelianavdetail[i]);
                    addPembelianAvalanRow();
                    $('#item'+i+'').val(response.pembelianavdetail[i].id_avalan);
                    $('#qty'+i+'').val(response.pembelianavdetail[i].qty);
                    $('#potongan'+i+'').val(response.pembelianavdetail[i].potongan);
                    $('#harga'+i+'').val(response.pembelianavdetail[i].harga);
                }
                recalcPembelianAvalan();
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
        $('#modal-form-payment .modal-title').text('Pembayaran Avalan');
        $('#modal-form-payment form').attr('action', url);
        $('#modal-form-payment [name=_method]').val('post');
    }
    
</script>
@endpush