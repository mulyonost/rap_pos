@extends('layouts.master')

@section('title')
    Laporan packing
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan packing</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border mb-2">
                <button onclick="addForm('{{ route('laporan_packing.store') }}')" class="btn btn-success btn-flat"><i class="fa fa-plus-circle"></i>Tambah Laporan Packing</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered" width="99.8%">
                    <thead>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Total Batang</th>
                        <th>Total Colly</th>
                        <th>Keterangan</th>
                        <th widht="5%"><i class="fa fa-cog"></i>Aksi</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@includeIf('laporan.packing_form')
@endsection

@push('scripts')

<script>

var i =0;
function addRowPacking(){
$('#mainbody').append('<tr><td>' +
    '<input class="form-control" type="hidden" name="addmore[' +i+ '][id]" id="id' +i+ '" value="">' +
    '<select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" required >' +
    '<option disabled="disabled" selected="selected" value="" >Select Produk</option>' +
        '@foreach($produk as $pro)' +
        '<option value="{{$pro->id}}" data-berat="{{ $pro->berat_maksimal }}">{{$pro->nama}}</option>' +
        '@endforeach' +
    '</select></td>' +
    '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required ></td>' +
    '<td><input step=".001" class="form-control berat" type="number" name="addmore['+i+'][berat]" id="berat'+i+'" required ></td>' +
    '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" required readonly></td>' +
    '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> -</button></td></tr>'
    )}

let table;

$(function () {
    table = $('.table').DataTable({
        processing: true,
        autowidth: true,
        ajax: {
            url: '{{ route('laporan_packing.data') }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable:false, sortable:false},
            {data: 'tanggal'},
            {data: 'total_btg'},
            {data: 'total_colly'},
            {data: 'keterangan', render: $.fn.dataTable.render.number('.', ',', 0, '', ' Kg') },
            {data: 'aksi', searchable:false, sortable:false}
        ]
    });
    showData();
    $('#modal-form').validator().on('submit', function (e) {
        if (! e.preventDefault()) {
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
    $('#modal-form .modal-title').text('Input Data Packing');
    $('#mainbody').empty();
    $('#modal-form').ready(getNomorPacking);
    $('#modal-form').ready(function() {
        addRowPacking();
        i++;
        $('.nama').select2({
            theme: "bootstrap"
        });
    });
    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('post');
    $('#modal-form [name=showfoto]').attr("src", null);
    $('#modal-form [name=nomor]').focus();
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
            $('#mainbody').empty();
            $('#modal-form [name=nomor]').val(response.packing.nomor);
            $('#modal-form [name=tanggal]').val(response.packing.tanggal);
            $('#modal-form [name=keterangan]').val(response.packing.keterangan);
            $('#modal-form [name=link]').attr("href", '{{ asset('uploads/laporan/packing') }}' + '/' + response.packing.foto);
            $('#modal-form [name=showfoto]').attr("src", '{{ asset('uploads/laporan/packing') }}' + '/' + response.packing.foto);
            if(response.packingdetail.length > 0){
                for (i=0 ; i < response.packingdetail.length; i++){
                    addRowPacking();
                    $('#id'+i+'').val(response.packingdetail[i].id);
                    $('#nama'+i+'').val(response.packingdetail[i].id_aluminium);
                    $('#qty'+i+'').val(response.packingdetail[i].qty_colly);
                    $('#berat'+i+'').val(response.packingdetail[i].qty_isi);
                }
            recalcPacking();
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