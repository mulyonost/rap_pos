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
                <a href="{{ route('pembelian_avalan.index') }}" class="btn btn-primary"><i class="fas fa-file-alt"></i> Index Avalan</a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%" id="tableData">
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
@includeIf('pembelian.avalan.pembelian_avalan_detail')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('#tableData').DataTable({
            dom: 'Bfrtip',
            pageLength: 25,
            processing: true,
            autowidth: true,
            ajax: {
                url: '{{ route('pembelian_avalan.pelunasan.data') }}',
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
                $('#modal-form [name=showfoto]').attr("src", '{{ asset('uploads/pembelian/avalan') }}' + '/' + response.pembelianav.foto_nota);
                $('#modal-form [name=link]').attr("href", '{{ asset('uploads/pembelian/avalan') }}' + '/' + response.pembelianav.foto_nota);
                $('#modal-form [name=nomor]').val(response.pembelianav.nomor);
                $('#modal-form [name=tanggal]').val(response.pembelianav.tanggal);
                $('#modal-form [name=supplier]').val(response.pembelianav.supplier.nama);
                $('#modal-form [name=due_date]').val(response.pembelianav.due_date);
                $('#modal-form [name=total]').val('Rp. ' + response.pembelianav.total_nota.toLocaleString());
                if (response.pembelianav.status == 0){
                    var status = "Belum Lunas";
                    $('#modal-form [name=status]').val(status);
                } else {
                    var status = "Lunas";
                    $('#modal-form [name=status]').val(status);
                }
                $('#modal-form [name=keterangan]').val(response.pembelianav.keterangan);
                var url = "{{ route('pembelian_avalan.cetakulang', '')}}" + "/" + response.pembelianav.id;
                $('#modal-form [id=cetak]').attr("href", url);
                $('#modal-form-payment [id=id_pembelian]').val(response.pembelianav.id);
                $('#modal-form-payment [id=nomor]').val(response.pembelianav.nomor);
                $('#modal-form-payment [id=total]').val('Rp. ' + response.pembelianav.total_nota.toLocaleString());
                $('#modal-form-payment [id=tanggal_pembayaran]').val(new Date().toISOString().slice(0, 10));
                $('#modal-form-payment [id=keterangan_pembayaran]').val(response.pembelianav.keterangan_bayar);
                $('#modal-form-payment [id=hapus]').hide();
                for (i=0; i<response.pembelianavdetail.length; i++){
                    addRowPembelianAvalanView();
                    $('#no'+i+'').text(i+1 + '.');
                    $('#item'+i+'').text(response.pembelianavdetail[i].avalan.nama);
                    $('#qty'+i+'').text(response.pembelianavdetail[i].qty.toLocaleString() + ' Kg');
                    $('#potongan'+i+'').text(response.pembelianavdetail[i].potongan.toLocaleString() + ' Kg');
                    $('#qty_akhir'+i+'').text(response.pembelianavdetail[i].qty_akhir.toLocaleString() + ' Kg');
                    $('#harga'+i+'').text('Rp. ' + response.pembelianavdetail[i].harga.toLocaleString());
                    $('#subtotal'+i+'').text('Rp. ' + response.pembelianavdetail[i].subtotal.toLocaleString());
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

    function addPayment(url){
        $('#modal-form-payment').modal('show');
        $('#modal-form-payment .modal-title').text('Pembayaran Avalan');
        $('#modal-form-payment form').attr('action', url);
        $('#modal-form-payment [name=_method]').val('post');
    }
    
</script>
@endpush