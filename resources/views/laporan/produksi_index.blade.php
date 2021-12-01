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
                <a href="{{ route('laporan_produksi.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Laporan Produksi</a>
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
var i=0;
function addRowProduksi(){
    $('#mainbody').append('<tr><td>' +
        '<input class="form-control" type="hidden" name="addmore[' +i+ '][id]" id="id' +i+ '" value="">' +
        '<input class="form-control" type="text" name="addmore['+i+'][matras]" id="matras'+i+'"></td>' +
        '<td><select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" required >' +
            '<option disabled="disabled" selected="selected" value="" >Select Produk</option>' +
            '@foreach($produk as $pro)' +
            '<option value="{{$pro->id}}" data-berat="{{ $pro->berat_maksimal }}">{{$pro->nama}}</option>' +
            '@endforeach' +
            '</select></td>' +
        '<td><input step=".001" class="form-control berat" type="number" name="addmore['+i+'][berat]" id="berat'+i+'" required ></td>' +
        '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required ></td>' +
        '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" required readonly></td>' +
        '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> -</button></td></tr>'
        )
}
    let table;
    $(function () {
        table = $('.table').DataTable({
            processing: true,
            autowidth: true,
            ajax: {
                url: '{{ route('laporan_produksi.data') }}',
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
        $('#mainbody').empty();
        $('#modal-form form')[0].reset();
        $('#modal-form').ready(function() {
            getNomorProduksi();
            addRowProduksi();
            i++;
            $('.nama').select2({
                theme: "bootstrap"
            });            
        });
        $('#modal-form .modal-title').text('Input Data Produksi');
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=id_laporan_produksi]').focus();
        $('#modal-form [name=showfoto]').attr("src", null);
    }
    function editForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Laporan Produksi');
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();
        $.get(url)
            .done((response) => {
                $('#modal-form [name=nomor]').val(response.produksi.nomor_laporan);
                $('#modal-form [name=tanggal]').val(response.produksi.tanggal);
                $('#modal-form [name=jumlah_billet]').val(response.produksi.jumlah_billet);
                $('#modal-form [name=jumlah_avalan]').val(response.produksi.jumlah_avalan);
                $('#modal-form [name=mesin]').val(response.produksi.mesin);
                $('#modal-form [name=shift]').val(response.produksi.shift);
                $('#modal-form [name=showfoto]').attr("src", '{{ asset('uploads/laporan/produksi') }}' + '/' + response.produksi.foto);
                $('#modal-form [name=anggota]').val(response.produksi.anggota);
                $('#mainbody').empty();
                if(response.produksidetail.length>0){
                    for(i=0; i<response.produksidetail.length;i++){
                        addRowProduksi();
                        $('#id' + i + '').val(response.produksidetail[i].id);
                        $('#matras' + i + '').val(response.produksidetail[i].no_matras);
                        $('#nama' + i + '').val(response.produksidetail[i].id_aluminium_base);
                        $('#berat' + i + '').val(response.produksidetail[i].berat);
                        $('#qty' + i + '').val(response.produksidetail[i].qty);
                    }
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
    
</script>
@endpush