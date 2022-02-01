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
                        <th>Nama Avalan</th>
                        <th>Total Qty</th>
                        <th>Total Pembelian</th>
                        <th>Harga Rata-rata</th>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
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
        var numFormatRp = $.fn.dataTable.render.number('.', ',', 0, 'Rp. ').display;
        var numFormat = $.fn.dataTable.render.number('.', ',', 0, '').display;
        table = $('#dataTable').DataTable({
            "order": [[ 1, "desc" ]],
            dom: 'Bfrtip',
            processing: true,
            autowidth: true,
            ajax: {
                url: '{{ route('reports_penjualan.data_avalan_group') }}',
            },
            columns: [
                {data: 'avalan.nama'},
                {data: 'qty', render: $.fn.dataTable.render.number('.', ',', 0, '') },
                {data: 'subtotal', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp. ') },
                {data: null, render: function(data,type,row) {return numFormatRp(data['subtotal'] / data['qty'])} },

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
                    .column( 2 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 2, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
 
                $( api.column( 2 ).footer() ).html(
                    numFormatRp(pageTotal) +' ('+ numFormatRp(total) +' total)'
                );

                 // Total over all pages
                total = api
                    .column( 1 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 1, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
 
                $( api.column( 1 ).footer() ).html(
                    numFormat(pageTotal) +' ('+ numFormat(total) +' total)'
                );
            }
        })

    });
</script>
@endpush