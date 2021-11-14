function recalcProduksi() {
  var berat = 0;
  var qty = 0;
  var grandtotal = 0;
  $('#kas_table').find('tr').each(function() {
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