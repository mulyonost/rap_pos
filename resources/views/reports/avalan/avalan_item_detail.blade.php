@extends('layouts.master')

@section('title')
    Laporan Avalan Detail
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Avalan</li>
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="row">
            <form class="form-inline" action="{{ route('reports_avalan.search') }}" >
                <div class="form-group mb-2">
                    <label>Tanggal Awal</label>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="date" class="form-control" id="tanggal-awal" name="tanggal-awal" value="<?=  date("Y-m-01")  ?>">
                </div>
                <div class="form-group mb-2">
                    <label>Tanggal Akhir</label>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="date" class="form-control" id="tanggal-akhir" name="tanggal-akhir" value="<?=  date("Y-m-d")  ?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2" value="avalan" name="type">Avalan</button>
                <button type="submit" class="btn btn-primary mb-2 ml-2" value="supplier" name="type">Group Supplier</button>
                <button type="submit" class="btn btn-primary mb-2 ml-2" value="avalan_group" name="type">Group Avalan</button>
            </form>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%" id="dataTable">
                    <thead>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Supplier</th>
                        <th>Nama Avalan</th>
                        <th>Qty</th>
                        <th>Potongan</th>
                        <th>Qty Akhir</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
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

@endsection

@push('scripts')

<script>

let table;

    $(function () {
        table = $('#dataTable').DataTable({
            "pageLength": 50,
            // "order": [[ 2, "desc" ]],
            dom: 'Bfrtip',
            processing: true,
            autowidth: true,
            ajax: {
                url: '{{ route('reports_penjualan.data_avalan') }}',
            },
            columns: [
                {data: 'master.tanggal'},
                {data: 'master.supplier.nama'},
                {data: 'avalan.nama'},
                {data: 'qty', render: $.fn.dataTable.render.number('.', ',', 0)},
                {data: 'potongan'},
                {data: 'qty_akhir', render: $.fn.dataTable.render.number('.', ',', 0) },
                {data: 'harga', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp') },
                {data: 'subtotal', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp') }
            ],
            footerCallback: function( tfoot, data, start, end, display ) {
                var api = this.api(), data;
                var numFormatRp = $.fn.dataTable.render.number('.', ',', 0, 'Rp. ').display;
                var numFormat = $.fn.dataTable.render.number('.', ',', 0, '').display;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
    
                // Total over all pages
                total = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 7, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
 
                $( api.column( 7 ).footer() ).html(
                    numFormatRp(pageTotal) +' ('+ numFormatRp(total) +' total)'
                );

                // Total over all pages
                total = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 5, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
 
                $( api.column( 5 ).footer() ).html(
                    numFormat(pageTotal) +' ('+ numFormat(total) +' total)'
                );
            }
        })

    });
</script>
@endpush