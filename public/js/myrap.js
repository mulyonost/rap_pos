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

function persentase() {
  var totalBillet = 0;
  var totalAvalan = 0;
  var totalProduksi = 0;
  var kgBillet = 0;
  var persen = 0;
  totalBillet = $('#jumlah_billet').val();
  totalAvalan = $('#jumlah_avalan').val();
  totalProduksi = $('#total').val();
  kgBillet = (totalBillet * 92);
  persen = Math.round(totalAvalan / totalBillet * 100) / 100 ;
  $('#persentase').text(persen);

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


// FORM PEMBELIAN BAHAN

function recalcPembelian() {
  let qty = 0;
  let harga = 0;
  let subtotal = 0;
  let totalNota = 0;
  $('#table').find('tr').each(function() {
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
  let r = (Math.random() + 1).toString(36).substring(7, 11).toUpperCase();
  var nomor = "PB-" + newDate + "-" + r;
  $('#nomor').val(nomor);
}


// FORM PEMBELIAN AVALAN
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
  let r = (Math.random() + 1).toString(36).substring(7, 11).toUpperCase();
  var nomor = "PA-" + newDate + "-" + r;
  $('#nomor').val(nomor);
}

function getPembelianAvalanJT() {
  var date = $('#tanggal').val();
  $('#due_date').val(date);
}


// PENJUALAN

function recalcPenjualan() {
  let colly = 0;
  let isi = 0;
  let qty = 0;
  let harga = 0;
  let subtotal = 0;
  let totalNota = 0;
  let diskonPersen = $('#diskon_persen').val();
  let diskonRupiah = 0;
  let totalAkhir = 0;
  $('#table').find('tr').each(function() {
      let colly = $(this).find('input.colly').val();
      let isi = $(this).find('input.isi').val();
      let harga = $(this).find('input.harga').val();
      let qty = (colly * isi);
      let subtotal = (qty * harga);
      $(this).find('input.qty').val(Math.round(qty * 100) / 100);
      $(this).find('input.subtotal').val(subtotal);
      totalNota += subtotal ? subtotal : 0;
  });
  diskonRupiah = diskonPersen/100 * totalNota;
  totalAkhir = (totalNota - diskonRupiah);
  $('#total_nota').val(totalNota);
  $('#diskon_rupiah').val(diskonRupiah);
  $('#total_akhir').val(totalAkhir);
}

function getNomorPenjualan() {
  var date = $('#tanggal').val();
  var newDate = date.replace(/-/g, "");
  let r = (Math.random() + 1).toString(36).substring(7, 11).toUpperCase();
  var nomor = "RAP-" + newDate + "-" + r;
  $('#nomor').val(nomor);
}