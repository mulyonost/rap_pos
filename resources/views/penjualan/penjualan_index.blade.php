
@extends('layouts.master')

@section('title')
Penjualan Aluminium
@endsection

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Penjualan Aluminium</li>
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/penjualan.css') }}"
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border mb-2">
                <a href="{{ route('penjualan_aluminium.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Penjualan Baru</a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%" id="dataTable">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Nama Customer</th>
                        <th>Total Nota</th>
                        <th>Rp/Kg</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th width="5%"><i class="fa fa-cog"></i>Aksi</th>
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
@includeIf('penjualan.penjualan_detail')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('#dataTable').DataTable({
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
                $('#modal-form [name=customer]').val(response.penjualan.customer.nama);
                $('#modal-form [name=due_date]').val(response.penjualan.due_date);
                $('#modal-form [name=foto_mobil]').val(response.foto_mobil);
                $('#modal-form [name=foto_barang]').val(response.foto_barang);
                $('#modal-form [name=timbangan]').val(response.penjualan.timbangan_mobil);
                $('#modal-form [name=total_nota]').val('Rp. ' + response.penjualan.total_nota.toLocaleString());
                $('#modal-form [name=diskon_rupiah]').val('Rp. ' + response.penjualan.diskon.toLocaleString());
                $('#modal-form [name=total_akhir]').val('Rp. ' + response.penjualan.total_akhir.toLocaleString());
                $('#modal-form [name=payment]').attr("onClick", 'addPayment (' + '\'' + '{{ route('penjualan_aluminium.payment') }}' + '/' + response.penjualan.id + '\')');
                if (response.penjualan.status == 0){
                    var status = "Belum Lunas";
                    $('#modal-form [name=status]').val(status);
                } else {
                    var status = "Lunas";
                    $('#modal-form [name=status]').val(status);
                }
                $('#modal-form [name=keterangan]').val(response.keterangan);
                var urlnota = "{{ route('penjualan_aluminium.cetakulangnota', '')}}" + "/" + response.penjualan.id;
                var urlsj = "{{ route('penjualan_aluminium.cetakulangsj', '')}}" + "/" + response.penjualan.id;
                $('#modal-form [id=cetaknota]').attr("href", urlnota);
                $('#modal-form [id=cetaksj]').attr("href", urlsj);
                for (i=0; i<response.penjualandetail.length; i++){
                    addRowPenjualanDetail();
                    $('#no'+i+'').text(i+1);
                    $('#nama'+i+'').text(response.penjualandetail[i].aluminium.nama);
                    $('#colly'+i+'').text(response.penjualandetail[i].colly);
                    $('#isi'+i+'').text(response.penjualandetail[i].isi);
                    $('#qty'+i+'').text(response.penjualandetail[i].qty.toLocaleString());
                    $('#harga'+i+'').text('Rp. ' + response.penjualandetail[i].harga.toLocaleString());
                    $('#subtotal'+i+'').text('Rp. ' + response.penjualandetail[i].subtotal.toLocaleString());   
                }

                $('#modal-form-payment [name=sisa]').val(response.penjualan.total_akhir);
                $('#modal-form-payment [id=sisa_awal]').val(response.penjualan.total_akhir);
                $('#modal-form-payment [id=nomornota]').val(response.penjualan.nomor);
                $('#modal-form-payment [name=id_penjualan]').val(response.penjualan.id);
                var url = "{{ route('penjualan_aluminium.paymentDelete', '')}}" + "/" + response.penjualan.id;
                $('#modal-form-payment [id=hapus]').attr("href", url);
                $('#modal-form-payment [id=simpan]').hide();
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
        $('#mainbody-payment').empty();      
        $('#jumlah0').val($('#sisa_awal').val());
        $('#modal-form-payment').modal('show');
        $('#modal-form-payment .modal-title').text('Pelunasan Penjualan Aluminium');
        $('#modal-form-payment form').attr('action', url);
        $('#modal-form-payment [name=_method]').val('post');
        $.get(url)
            .done((response) => {
                if (response.payment.length > 0){
                    for(x=0; x<response.payment.length; x++){
                        addRowPayment();
                        $('#bank'+x+'').val(response.payment[x].bank);
                        $('#tanggal'+x+'').val(response.payment[x].tanggal);
                        $('#jumlah'+x+'').val(response.payment[x].jumlah);
                        $('#keterangan'+x+'').val(response.payment[x].keterangan);
                        hitungSisa();
                    }
                }
                else {
                    addRowPayment();
                }
            });
    }
    
</script>
@endpush