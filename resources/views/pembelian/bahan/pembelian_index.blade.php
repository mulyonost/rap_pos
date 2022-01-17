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
                <a href="{{ route('pembelian_bahan.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Pembelian Baru</a>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%" id="dataTable">
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
@includeIf('pembelian.bahan.pembelian_bahan_detail')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('#dataTable').DataTable({
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

    function editForm(url){
  $('#modal-form').modal('show');
  $('#modal-form form')[0].reset();
  $('#modal-form form').attr('action', url);
  $('#modal-form [name=_method]').val('put');
  $('#modal-form [name=nama]').focus();

  $.get(url)
  .done((response) => {
          $('#mainbody').empty();    
          $('#modal-form [name=nomor]').val(response.pembelian.nomor);
          $('#modal-form [name=tanggal]').val(response.pembelian.tanggal);
          $('#modal-form [name=supplier]').val(response.pembelian.supplier.nama);
          $('#modal-form [name=due_date]').val(response.pembelian.due_date);
          if (response.pembelian.status == 0){
              var status = "Belum Lunas";
              $('#modal-form [name=status]').val(status);
          } else {
              var status = "Lunas";
              $('#modal-form [name=status]').val(status);
          }
          $('#modal-form [name=showfoto]').attr("src", '{{ asset('uploads/pembelian/bahan') }}' + '/' + response.pembelian.foto);
          $('#modal-form [name=link]').attr("href", '{{ asset('uploads/pembelian/bahan') }}' + '/' + response.pembelian.foto);
          $('#modal-form [name=keterangan]').val(response.pembelian.keterangan);
          $('#modal-form [name=total]').val('Rp. ' + response.pembelian.total.toLocaleString());
          $('#modal-form-payment [id=nomor]').val(response.pembelian.nomor);
          $('#modal-form-payment [id=total]').val(response.pembelian.total.toLocaleString());
          $('#modal-form-payment [id=tanggal_pembayaran]').val(response.pembelian.tanggal_bayar);
          $('#modal-form-payment [id=keterangan_pembayaran]').val(response.pembelian.keterangan_bayar);
          $('#modal-form-payment [id=keterangan_pembayaran]').attr('readonly', true);
          $('#modal-form-payment [id=tanggal_pembayaran]').attr('readonly', true)
          $('#modal-form-payment [id=simpan]').attr('disabled', true)
          var url = "{{ route('pembelian_bahan.paymentDelete', '')}}" + "/" + response.pembelian.id;
          $('#modal-form-payment [id=hapus]').attr("href", url);
          $('#modal-form-payment [name=id_pembelian]').val(response.pembelian.id);
          for (i=0; i<response.pembeliandetail.length; i++){
              addRowPembelianView();
              $('#nama'+i+'').text(response.pembeliandetail[i].items.nama);
              $('#qty'+i+'').text(response.pembeliandetail[i].qty.toLocaleString() + ' ' + response.pembeliandetail[i].items.unit);
              $('#harga'+i+'').text('Rp. ' + response.pembeliandetail[i].harga.toLocaleString());
              $('#subtotal'+i+'').text('Rp. ' + response.pembeliandetail[i].subtotal.toLocaleString());
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