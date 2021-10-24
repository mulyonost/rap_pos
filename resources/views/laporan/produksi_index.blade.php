@extends('layouts.master')

@section('title')
    Laporan Produksi
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Produksi</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border mb-2">
                <button onclick="addForm('{{ route('produksi.store') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i>Tambah Laporan Produksi</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Mesin</th>
                        <th>Shift</th>
                        <th>Total Produksi</th>
                        <th widht="5%"><i class="fa fa-cog"></i>Aksi</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@includeIf('laporan.produksi_form')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            processing: true,
            autowidth: true,
            ajax: {
                url: '{{ route('produksi.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable:false, sortable:false},
                {data: 'tanggal'},
                {data: 'mesin'},
                {data: 'shift'},
                {data: 'total_produksi', render: $.fn.dataTable.render.number('.', ',', 0, '', ' Kg') },
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

    function addForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Input Data Produksi');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=id_laporan_produksi]').focus();

    }

    function editForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Laporan Produksi');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();

        // var array = jQuery.parseJSON(response);
        // produksi = array[0];
        // produksidetail = array[1]
        $.get(url)
            .done((response) => {
                $('#modal-form [name=nomor]').val(response.nomor_laporan);
                $('#modal-form [name=tanggal]').val(response.tanggal);
                $('#modal-form [name=jumlah_billet]').val(response.jumlah_billet);
                $('#modal-form [name=jumlah_avalan]').val(response.jumlah_avalan);
                $('#modal-form [name=mesin]').val(response.mesin);
                $('#modal-form [name=shift]').val(response.shift);
                $('#modal-form [name=foto]').val(response.foto);
                $('#modal-form [name=anggota]').val(response.anggota);
                $('#modal-form [name=total_produksi]').val(response.total_produksi);
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