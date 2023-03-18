// GLOBAL JQUERY

var imageLoader = document.getElementById('filePhoto');
    imageLoader.addEventListener('change', handleImage, false);

function handleImage(e) {
    var reader = new FileReader();
    reader.onload = function (event) {
        
        $('.uploader img').attr('src',event.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
}

$(document).on('click', '.remove', function(event) {
  jQuery(this).parent().parent().remove();
  return false;
});

$(document).on('select2:open', () => {
  document.querySelector('.select2-search__field').focus();
});

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function makeid(length) {
  var result           = '';
  var characters       = 'ABCDEFGHJKLMNPQRSTUVYZ23456789';
  var charactersLength = characters.length;
  for ( var i = 0; i < length; i++ ) {
    result += characters.charAt(Math.floor(Math.random() *  charactersLength));
  }
  return result;
}

//FORM PRODUKSI

function recalcProduksi() {
  var berat = 0;
  var qty = 0;
  var grandtotal = 0;
  $('#detail_table').find('tr').each(function() {
    var berat = $(this).find('input.berat').val();
    var qty = $(this).find('input.qty').val();
    var subtotal = (berat * qty);
    let berat_max = $(this).find('option:selected').data('berat');
    $(this).find('input.subtotal').val(Math.round(subtotal * 100) / 100);
    // $(this).find('input.berat').val(berat_max);
    grandtotal += isNumber(subtotal)  ? subtotal : 0;
  });
  $('#total').val(Math.round(grandtotal * 100) / 100 );
}

function getNomorProduksi() {
	var date= $('#tanggal').val();
  var newDate = date.replace(/-/g, "");
  var mesin = $('#mesin').val();
  $('#nomor').val(newDate + "-" + mesin);
}

function persentase() {
  var totalBillet = 0;
  var totalAvalan = 0;
  var totalProduksi = 0;
  var kgBillet = 0;
  var persen = 0;
  totalBillet = $('#jumlah_billet').val();
  totalAvalan = $('#jumlah_avalan').val();
  totalProduksi = $('#total').val();
  kgBillet = (totalBillet * 95);
  persen = Math.round(totalProduksi / totalBillet * 100) / 100 ;
  $('#persentase').text(persen);

}


// FORM ANODIZING

function addRowAnodizing(){
  $('#mainbody').append('<tr><td>' +
    '<input class="form-control" type="hidden" name="addmore[' +i+ '][id]" id="id' +i+ '" value="">' +
    '<select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" required >' +
    '<option disabled="disabled" selected="selected" value="" >Select Produk</option>' +
    '</select></td>' +
    '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required ></td>' +
    '<td><input step=".001" class="form-control berat" type="number" name="addmore['+i+'][berat]" id="berat'+i+'" required ></td>' +
    '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" required readonly></td>' +
    '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> -</button></td></tr>'
  )
}

function recalcAnodizing() {
  var berat = 0;
  var qty = 0;
  var grandtotal = 0;
  var grandtotalbtg = 0;
  $('#detail_table').find('tr').each(function() {
    var berat = $(this).find('input.berat').val();
    var qty = $(this).find('input.qty').val();
    var subtotal = (berat * qty);
    var subtotalbtg = (qty * 1);
    let berat_max = $(this).find('option:selected').data('berat');
    $(this).find('input.subtotal').val(Math.round(subtotal * 100) / 100);
    $(this).find('input.berat').val(berat_max).text();
    grandtotal += isNumber(subtotal)  ? subtotal : 0;
    grandtotalbtg += isNumber(subtotalbtg) ? subtotalbtg : 0;
  });
  $('#total_kg').val(Math.round(grandtotal * 100) / 100 );
  $('#total_btg').val(grandtotalbtg);
}

function getNomorAnodizing() {
	var date= $('#tanggal').val();
  var newDate = date.replace(/-/g, "");
  $('#nomor').val(newDate);
}

// FORM PACKING

function addRowPacking(){
  $('#mainbody').append('<tr><td>' +
      '<input class="form-control" type="hidden" name="addmore[' +i+ '][id]" id="id' +i+ '" value="">' +
      '<select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" onchange="selectProduct(this)" required >' +
      '<option disabled="disabled" selected="selected" value="" >Select Produk</option>' +
      '</select></td>' +
      '<td><input class="form-control colly" type="number" name="addmore['+i+'][colly]" id="colly'+i+'" required ></td>' +
      '<td><input class="form-control isi" type="number" name="addmore['+i+'][isi]" id="isi'+i+'" required ></td>' +
      '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" required readonly></td>' +
      '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> -</button></td></tr>'
  )
}

function populateSelectAluminium(){
  for (e = 0; e < produk.length; e++){ 
    $('.nama').append( '<option value="'+ produk[e].id +'" data-isi="'+ produk[e].packing +'">'+ produk[e].nama +'</option>' );
    }
}
function recalcPacking() {
  var grandtotal = 0;
  var grandtotalbtg = 0;
  $('#detail_table').find('tr').each(function() {
    var colly = $(this).find('input.colly').val();
    var isi = $(this).find('input.isi').val();
    var subtotal = (colly * isi);
    var subtotalbtg = (colly * 1);
    $(this).find('input.subtotal').val(Math.round(subtotal * 100) / 100);
    grandtotal += isNumber(subtotal)  ? subtotal : 0;
    grandtotalbtg += isNumber(subtotalbtg) ? subtotalbtg : 0;
  });
  $('#total_btg').val(Math.round(grandtotal * 100) / 100 );
  $('#total_colly').val(grandtotalbtg);
}

function getNomorPacking() {
  var date= $('#tanggal').val();
  var newDate = date.replace(/-/g, "");
  $('#nomor').val(newDate);
}


// FORM PEMBELIAN BAHAN

function addRowPembelian(){
  $('#mainbody').append('<tr><td>' +
  '<select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" onchange="selectProduct(this)" required>' +
      '<option value="">Pilih Barang</option>' +
  '</select></td>' +
  '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required></td>' +
  '<td><input class="form-control harga" type="number" step="0.01" name="addmore['+i+'][harga]" id="harga'+i+'" required></td>' +
  '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" readonly></td>' +
  '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> - </button></td>'
  )
}

function addRowPembelianView(){
  $('#mainbody').append('<tr><td>' +
  '<p id="nama'+i+'"></p></td>' +
  '<td><p id="qty'+i+'"></p></td>' +
  '<td><p id="harga'+i+'"></p></td>' +
  '<td><p id="subtotal'+i+'"></p></td>'
  )
}

function populateSelectPembelian(){
  for (e = 0; e < items.length; e++){ 
      $('#nama' + i + '').append( '<option value="'+ items[e].id +'" data-harga="'+ items[e].harga +'">'+ items[e].nama +'</option>' );
  }
}

function recalcPembelian() {
  let qty = 0;
  let harga = 0;
  let subtotal = 0;
  let totalNota = 0;
  $('#table-detail').find('tr').each(function() {
      let qty = $(this).find('input.qty').val();
      let harga = $(this).find('input.harga').val();
      let subtotal = (qty * harga);
      $(this).find('input.subtotal').val(subtotal);
      totalNota += subtotal ? subtotal : 0;
  });
  $('#total_nota').val(totalNota);
}


function getNomorPembelianBahan() {
  var date = $('#tanggal').val();
  var newDate = date.replace(/-/g, "");
  var nomor = "PB-" + newDate + "-" + makeid(4);
  $('#nomor').val(nomor);
}


// FORM PEMBELIAN AVALAN

function addPembelianAvalanRow(){
  $('#mainbody').append(
    '<tr>' +
        '<td><select class="form-control item" id="item' + i + '" name="addmore[' + i + '][item]" onchange="selectProduct(this)">' +
            '<option value="" selected="" disabled>Pilih Item</option>' +
        '</select></td>' +
        '<td><input class="form-control qty" type="number" step="0.01" id="qty'+ i +'" name="addmore['+ i +'][qty]"></td>' +
        '<td><input class="form-control potongan" type="number" step="0.01" id="potongan'+ i +'" name="addmore['+ i +'][potongan]" value=0></td>' +
        '<td><input class="form-control qty_akhir" type="number" step="0.01" id="qty_akhir'+ i +'" name="addmore['+ i +'][qty_akhir]" readonly tabindex="-1"></td>' +
        '<td><input class="form-control harga" type="number" id="harga'+ i +'" name="addmore['+ i +'][harga]" value=0> <span></span></td>' +
        '<td><input class="form-control subtotal" type="number" id="subtotal'+ i +'" name="addmore['+ i +'][subtotal]" readonly></td>' +
        '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> -</button></td>' +
    '</tr>' 
    )
}

function addRowPembelianAvalanView(){
  $('#mainbody').append('<tr><td>' +
  '<p id="no'+i+'"></p></td>' +
  '<td><p id="item'+i+'"></p></td>' +
  '<td><p id="qty'+i+'"></p></td>' +
  '<td><p id="potongan'+i+'"></p></td>' +
  '<td><p id="qty_akhir'+i+'"></p></td>' +
  '<td><p id="harga'+i+'"></p></td>' +
  '<td><p id="subtotal'+i+'"></p></td>'
  )
}

function populateSelectAvalan(){
  for (e = 0; e < avalan.length; e++){ 
      $('#item' + i + '').append( '<option value="'+ avalan[e].id +'" data-harga="'+ avalan[e].harga +'">'+ avalan[e].nama +'</option>' );
  }
}

function recalcPembelianAvalan() {
  let qty = 0;
  let harga = 0;
  let subtotal = 0;
  let totalNota = 0;
  $('#table-detail').find('tr').each(function() {
      let qty = $(this).find('input.qty').val();
      let potongan = $(this).find('input.potongan').val()
      let harga = $(this).find('input.harga').val();
      let qty_akhir = qty - potongan;
      let subtotal = (qty_akhir * harga);
      $(this).find('input.qty_akhir').val(qty_akhir);
      $(this).find('input.subtotal').val(subtotal);
      totalNota += subtotal ? subtotal : 0;
  });
  $('.total_nota').val(totalNota);
}

function getNomorPembelianAvalan() {
  var date = $('#tanggal').val();
  var newDate = date.replace(/-/g, "");
  var nomor = "PA-" + newDate + "-" + makeid(4);
  $('#nomor').val(nomor);
}

function getPembelianAvalanJT() {
  var date = $('#tanggal').val();
  $('#due_date').val(date);
}

function getSupplier() {
  let supplier = $('#supplier option:selected').text();
  $('#nama_supp').val(supplier);
}


// PENJUALAN
function addRowPenjualan(){
  $('#mainbody').append('<tr><td>' +
          '<select class="form-control nama" name="addmore['+i+'][nama]" id="nama'+i+'" onchange="selectProduct(this)" required>' +
              '<option value="">Pilih Barang</option>' +
          '</select></td>' +
          '<td><input class="form-control colly" type="number" name="addmore['+i+'][colly]" id="colly'+i+'" required></td>' +
          '<td><input class="form-control isi" type="number" name="addmore['+i+'][isi]" id="isi'+i+'" required></td>' +
          '<td><input class="form-control qty" type="number" name="addmore['+i+'][qty]" id="qty'+i+'" required readonly tabindex=-1></td>' +
          '<td><input class="form-control harga" type="number" name="addmore['+i+'][harga]" id="harga'+i+'" required></td>' +
          '<td><input class="form-control subtotal" type="number" name="addmore['+i+'][subtotal]" id="subtotal'+i+'" readonly></td>' +
          '<td><button id="remove_row" type="button" name="remove_row" class="btn btn-sm btn-danger remove"> - </button></td>'
      )
  }

  
function addRowPenjualanDetail(){
  $('#mainbody').append('<tr><td>' +
  '<p id="no'+i+'"></p></td>' +
  '<td><p id="nama'+i+'"></p></td>' +
  '<td><p id="colly'+i+'"></p></td>' +
  '<td><p id="isi'+i+'"></p></td>' +
  '<td><p id="qty'+i+'"></p></td>' +
  '<td><p id="harga'+i+'"></p></td>' +
  '<td><p id="subtotal'+i+'"></p></td>'
  )
}

function recalcPenjualan() {
  let colly = 0;
  let isi = 0;
  let qty = 0;
  let harga = 0;
  let subtotal = 0;
  let totalNota = 0;
  let diskonRupiah = $('#diskon_rupiah').val();
  let totalAkhir = 0;
  $('#table-detail').find('tr').each(function() {
      let colly = $(this).find('input.colly').val();
      let isi = $(this).find('input.isi').val();
      let harga = $(this).find('input.harga').val();
      let qty = (colly * isi);
      let subtotal = (qty * harga);
      $(this).find('input.qty').val(Math.round(qty * 100) / 100);
      $(this).find('input.subtotal').val(subtotal);
      totalNota += subtotal ? subtotal : 0;
  });
  totalAkhir = (totalNota - diskonRupiah);
  $('#total_nota').val(totalNota);
  $('#total_akhir').val(totalAkhir);
}

function recalcDiskon(){
  let diskonPersen = $('#diskon_persen').val();
  let diskonRupiah = 0;
  let totalNota = $('#total_nota').val();
  diskonRupiah = diskonPersen/100 * totalNota;
  $('#diskon_rupiah').val(diskonRupiah);
}

function getNomorPenjualan() {
  var date = $('#tanggal').val();
  var newDate = date.replace(/-/g, "");
  var nomor = "RAP-" + newDate + "-" + makeid(4);
  $('#nomor').val(nomor);
}

function populateSelectPenjualan(){
  for (e = 0; e < aluminium.length; e++){ 
      $('#nama' + i + '').append( '<option value="'+ aluminium[e].id +'" data-harga="'+ aluminium[e].harga_jual +'" data-isi="' + aluminium[e].packing + '">'+ aluminium[e].nama +'</option>' );
  }
}

function addRowPayment(){
  $('#mainbody-payment').append('<tr><td>' +
          '<input class="form-control bank" type="text" name="addmore['+x+'][bank]" id="bank'+x+'" value="BCA" required></td>' +
          '<td><input class="form-control tanggal" type="date" name="addmore['+x+'][tanggal]" id="tanggal'+x+'" required></td>' +
          '<td><input class="form-control jumlah" type="number" name="addmore['+x+'][jumlah]" id="jumlah'+x+'" required></td>' +
          '<td><input class="form-control keterangan" type="text" name="addmore['+x+'][keterangan]" id="keterangan'+x+'"></td>'
      )
      var today = new Date().toISOString().split('T')[0];
      $('#tanggal' + x ).val(today);
  }

  function hitungSisa(){
    var payment = 0;
    var totalPayment = 0;
    var sisa_akhir = 0;
    var sisa_awal = $('#sisa_awal').val();
    $('#table-detail-payment').find('tr').each(function() {
        var payment = $(this).find('input.jumlah').val() * 1;
        totalPayment += payment ? payment : 0;
    });
    sisa_akhir = (sisa_awal - totalPayment)
    $('#sisa').val(sisa_akhir);
}
