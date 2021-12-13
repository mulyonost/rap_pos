<head>

    <meta charset="utf-8">
    <title>Cetak SJ</title>
  
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
              <p1>PT. Aluminium<br>Jl. Kima 16 Kav DD 7<br>Makassar, Sulawesi Selatan</p>
          </div>
          <div class="col text-right">
              <p1 class="text-right">{{ $penjualan->nomor }}<br>{{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d-M-Y')}}<br>{{ $penjualan->created_by }}</p>
          </div>
      </div>
      <div class="row">
          <div class="col">
              <h5 class="text-center">Surat Jalan</h5>
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
                                              <th width="35%" style="text-align: left;">Nama Barang</th>
                                              <th width="10%" style="text-align: right;">Colly</th>
                                              <th width="10%" style="text-align: right;">Isi</th>
                                              <th width="15%" style="text-align: right;">Total Btg</th>
                                              <th width="25%" style="text-align: left;">Keterangan</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $colly=0; $batang=0  ?>
                                          @foreach ($penjualandetail as $key=>$value)
                                          <tr>
                                              <td>{{ $key+1 }}</td>
                                              <td class="">{{ $value->aluminium->nama }}</td>
                                              <td class="number">{{ number_format($value->colly) }}</td>
                                              <td class="number">{{ number_format($value->isi) }} Btg</td>
                                              <td class="number">{{ number_format($value->qty) }} Btg</td>
                                              <td>{{ $value->colly }} @ {{ $value->isi }}</td>
                                          </tr>
                                          <?php $colly += $value->colly; $batang +=$value->qty  ?>
                                          @endforeach                                        
                                          <tr>
                                              <td class="text-left border-secondary" colspan="4">Barang sudah diterima dengan baik dan dengan jumlah yang benar</td>
                                              <td class="text-right border-secondary"></td>
                                              <td class="border-secondary number"></b><b>Total Colly : {{ $colly }} Colly</b> </td>
                                          </tr>
                                          <tr>
                                              <td class="text-left" colspan="4">Terima Kasih.</td>
                                              <td class="text-right"></td>
                                              <td class= "number"><b>Total Batang : {{ number_format($batang) }} Btg</b></td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>

                              <div class="row-ml-5 mb-4">
                                  Nama Security :<br>
                                  Nama Sopir : <br>
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