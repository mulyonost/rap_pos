@extends('layouts.master')

@section('title')
    Laporan Penjualan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Penjualan</li>
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="row">
            <form class="form-inline" action="{{ route('reports_penjualan.search') }}" >
                <div class="form-group mb-2">
                    <label>Tanggal Awal</label>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal-awal" value="<?=  date("Y-m-01")  ?>">
                </div>
                <div class="form-group mb-2">
                    <label>Tanggal Akhir</label>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal-akhir" value="<?=  date("Y-m-d")  ?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2" value="item" name="type">Items</button>
                <button type="submit" class="btn btn-primary mb-2 ml-2" value="customer" name="type">Group Customer</button>
                <button type="submit" class="btn btn-primary mb-2 ml-2" value="items" name="type">Group Items</button>
            </form>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%" id="dataTable">
                    <thead>
                        <th>Nama Customer</th>
                        <th>ID Aluminium</th>
                        <th>Tanggal Transaksi</th>
                        <th>Colly</th>
                        <th>Isi</th>
                        <th>Qty</th>
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
            "order": [[ 2, "desc" ]],
            dom: 'Bfrtip',
            processing: true,
            autowidth: true,
            ajax: {
                url: '{{ route('reports_penjualan.data_items') }}',
            },
            columns: [
                {data: 'master.customer.nama'},
                {data: 'aluminium.nama'},
                {data: 'master.tanggal'},
                {data: 'colly'},
                {data: 'isi'},
                {data: 'qty', render: $.fn.dataTable.render.number('.', ',', 0) },
                {data: 'harga', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp') },
                {data: 'subtotal', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp') }
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
                    numFormat(pageTotal) +' ('+ numFormat(total) +' total)'
                );
            }
        })

    });
</script>
@endpush