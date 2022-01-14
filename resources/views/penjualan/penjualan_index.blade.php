@extends('layouts.master')

@section('title')
    Penjualan Aluminium
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Penjualan Aluminium</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border mb-2">
                <a href="{{ route('penjualan_aluminium.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Penjualan Baru</a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Nama Customer</th>
                        <th>Total Nota</th>
                        <th>Rp/Kg</th>
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
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@includeIf('penjualan.penjualan_form')
@endsection

@push('scripts')
<script>
    let table;
    // let numFormat = render: $.fn.dataTable.render.number('.', ',', 0, 'Rp').display;

    $(function () {
        table = $('.table').DataTable({
            dom: 'Bfrtip',
            processing: true,
            autowidth: true,
            ajax: {
                url: '{{ route('penjualan_aluminium.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable:false, sortable:false},
                {data: 'nomor'},
                {data: 'tanggal'},
                {data: 'customer.nama'},
                {data: 'total_akhir', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp') },
                {data: null, render: function(data,type,row) {return (data['total_akhir'] / data['timbangan_mobil'])}},
                {data: 'due_date'},
                {data: 'status'},
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
                    pageTotal +' ('+ total +' total)'
                );
            }
        })

    });

    function addForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Input Penjualan');
        $('#modal-form form')[0].reset();
        $('#mainbody').empty();
        $('#modal-form').ready(function() {
            getNomorPenjualan();
            addRowPenjualan();
            i++;
            $('.nama').select2({
                theme: "bootstrap-5"
            });            
        });
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nomor]').focus();
    }

    function addRowPenjualan(){
        $('#mainbody').append('<tr><td>' +
                '<select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" required>' +
                    '<option value="">Pilih Barang</option>' +
                    '@foreach ($aluminium as $alma)' +
                    '<option value="{{$alma->id}}">{{$alma->nama}}</option>' +
                    '@endforeach' +
                '</select></td>' +
                '<td><input class="form-control colly" type="number" name="addmore['+i+'][colly]" id="colly'+i+'" required></td>' +
                '<td><input class="form-control isi" type="number" name="addmore['+i+'][isi]" id="isi'+i+'" required></td>' +
                '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required readonly tabindex=-1></td>' +
                '<td><input class="form-control harga" type="number" name="addmore['+i+'][harga]" id="harga'+i+'" required></td>' +
                '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" readonly></td>' +
                '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> - </button></td>'
            )
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
                    addRowPenjualan();
                    $('#nama'+i+'').val(response.penjualandetail[i].id_aluminium);
                    $('#colly'+i+'').val(response.penjualandetail[i].colly);
                    $('#isi'+i+'').val(response.penjualandetail[i].isi);
                    $('#qty'+i+'').val(response.penjualandetail[i].qty);
                    $('#harga'+i+'').val(response.penjualandetail[i].harga);
                    $('#subtotal'+i+'').val(response.penjualandetail[i].subtotal);
                    $('.nama').select2({
                        theme: "bootstrap-5"
                    });       
                }
                recalcPenjualan();
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