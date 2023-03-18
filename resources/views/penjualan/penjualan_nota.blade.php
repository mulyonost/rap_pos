<head>

    <meta charset="utf-8">
    <title>Cetak Nota</title>
  
    {{-- Paper CSS --}}
    <link rel="stylesheet" href="{{ asset('css/paper.css')}}">
  
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  
    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
          @page {
              size: A4 portrait;
              margin: 0;
          }
          body {
              min-width: initial !important;
          }
  
          thead {
              text-align: center;
          }
  
          p1 {font-size: 0.75em; /* 14px/16=0.875em */}
          th {font-size: 0.75em;}
          td {font-size: 0.75em;}
  
          .number {
              text-align: right;
          }
    </style>
  </head>
  
  <body class="A4 portrait">
    <section class="sheet padding-10mm">
      <div class="row">
          <div class="col text-left">
              <p1><br>Jl. Kima 16 Kav DD 7<br>Makassar, Sulawesi Selatan</p>
          </div>
          <div class="col text-right">
              <p1 class="text-right">{{ $penjualan->nomor }}<br>{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d-M-Y')}}<br>{{ $penjualan->created_by }}</p>
          </div>
      </div>
      <div class="row">
          <div class="col">
              <h5 class="text-center">Nota Penjualan</h5>
              <div class="row">
                  <div class="col">
                      <p1>Nama Customer : {{ $penjualan->customer->nama }}<br>{{ $penjualan->customer->alamat }}</p>
                      <div class="row">
                          <div class="col">
                              <div class="table-responsive">
                                  <table class="table table-sm tbl-avalan">
                                      <thead>
                                          <tr>
                                              <th width="5%">No</th>
                                              <th width="45%" style="text-align: left;">Nama Barang</th>
                                              <th width="15%" style="text-align: right;">Qty</th>
                                              <th width="15%" style="text-align: right;">Harga</th>
                                              <th width="20%" style="text-align: right;">Subtotal</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $total=0; $subtotal=0  ?>
                                          @foreach ($penjualandetail as $key=>$value)
                                          <tr>
                                              <?php $subtotal=($value->qty-$value->potongan)*$value->harga ?>
                                              <td>{{ $key+1 }}</td>
                                              <td class="">{{ $value->aluminium->nama }}</td>
                                              <td class="number">{{ number_format($value->qty) }} Btg</td>
                                              <td class="number">Rp. {{ number_format($value->harga) }}</td>
                                              <td class="number">Rp. {{ number_format($value->subtotal) }}</td>
                                          </tr>
                                          <?php $total += $subtotal  ?>
                                          @endforeach                                        
                                          <tr>
                                              <td class="text-left border-secondary" colspan="3">Terbilang : {{ ucwords(terbilang($penjualan->total_nota)) }} Rupiah</td>
                                              <td class="text-right border-secondary"><b>Total</b></td>
                                              <td class="border-secondary number"><b>Rp. {{ number_format($penjualan->total_nota) }} </b></td>
                                          </tr>
                                          <tr>
                                              <td colspan="3">Jatuh Tempo : {{ \Carbon\Carbon::parse($penjualan->due_date)->format('d-M-Y')}}</td>
                                              <td class="text-right"><b>Diskon</b></td>
                                              <td class="number"><b>Rp. {{ number_format($penjualan->diskon) }} </b></td>                                          
                                          </tr>
                                          <tr>
                                            <td colspan="3"></td>
                                            <td class="text-right"><b>Total Transfer</b></td>
                                            <td class="number"><b>Rp. {{ number_format($penjualan->total_akhir) }} </b></td>                                          
                                        </tr>
                                      </tbody>
                                  </table>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <p class="text-center" style="margin-top: 10px;">Penerima</p>
                                  </div>
                                  <div class="col">
                                      <p class="text-center" style="margin-top: 10px;">Yang Menyerahkan</p>
                                  </div>
                                  <div class="col"></div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <p class="text-center" style="margin-top: 40px;">(_________________)</p>
                                  </div>
                                  <div class="col">
                                      <p class="text-center" style="margin-top: 40px;">(_________________)</p>
                                  </div>
                                  <div class="col"></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  
    </section>
  
  </body>
  
  </html>