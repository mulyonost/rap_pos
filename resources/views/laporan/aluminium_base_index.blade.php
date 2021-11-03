@extends('layouts.master')

@section('title')
    Daftar Aluminium Produksi
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Aluminium Base</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border mb-2">
                <button onclick="addForm('{{ route('aluminiumbase.store') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i>Tambah Aluminium</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%">
                    <thead>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Berat Avg</th>
                        <th>Berat Maks</th>
                        <th>Stok Awal</th>
                        <th>Stok Min</th>
                        <th>Stok Skrg</th>
                        <th>Ket</th>
                        <th widht="5%"><i class="fa fa-cog"></i>Aksi</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@includeIf('laporan.aluminium_base_form')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            pageLength: 25,
            processing: true,
            autowidth: true,
            ajax: {
                url: '{{ route('aluminiumbase.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable:false, sortable:false},
                {data: 'nama'},
                {data: 'berat_avg'},
                {data: 'berat_maksimal'},
                {data: 'stok_awal'},
                {data: 'stok_minimum'},
                {data: 'stok_sekarang'},
                {data: 'keterangan'},
                {data: 'aksi', searchable:false, sortable:false}
            ]
        });
        showData();
        $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                let formData = new FormData(this);
                $.ajax({
                    url: $('#modal-form form').attr('action'),
                    contentType : false,
                    processData : false,
                    type: 'post',
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
        $('#modal-form .modal-title').text('Tambah Aluminium Produksi');
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama]').focus();
        $('#modal-form [name=showfoto]').attr("src", null);

    }

    function editForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Aluminium');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama]').val(response.nama);
                $('#modal-form [name=berat_avg]').val(response.berat_avg);
                $('#modal-form [name=berat_maksimal]').val(response.berat_maksimal);
                $('#modal-form [name=stok_awal]').val(response.stok_awal);
                $('#modal-form [name=stok_minimum]').val(response.stok_minimum);
                $('#modal-form [name=stok_sekarang]').val(response.stok_sekarang);
                $('#modal-form [name=showfoto]').attr("src", '{{ asset('uploads/aluminium') }}' + '/' + response.foto);
                $('#modal-form [name=keterangan]').val(response.keterangan);
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