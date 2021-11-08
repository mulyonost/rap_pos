function add_row_produksi(){
    var i=-1;
    i++;
    $('#mainbody').append('<tr><td>' +
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
    $('.nama').select2({
      theme: "bootstrap"
    });
  }