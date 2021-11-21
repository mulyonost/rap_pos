// GLOBAL JQUERY

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


// FORM ANODIZING

function recalcAnodizing() {
  var berat = 0;
  var qty = 0;
  var grandtotal = 0;
  var grandtotalbtg = 0;
  $('#kas_table').find('tr').each(function() {
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

function recalcPacking() {
  var berat = 0;
  var qty = 0;
  var grandtotal = 0;
  var grandtotalbtg = 0;
  $('#kas_table').find('tr').each(function() {
    var berat = $(this).find('input.berat').val();
    var qty = $(this).find('input.qty').val();
    var subtotal = (berat * qty);
    var subtotalbtg = (qty * 1);
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



function getNomorPembelianBahan() {
  var date = $('#tanggal').val();
  var newDate = date.replace(/-/g, "");
  let r = (Math.random() + 1).toString(36).substring(7, 11).toUpperCase();
  var nomor = "PB-" + newDate + "-" + r;
  $('#nomor').val(nomor);
}
