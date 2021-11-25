<head>

  <meta charset="utf-8">
  <title>Cetak Nota</title>

  {{-- Paper CSS --}}
  <link rel="stylesheet" href="{{ asset('css/paper.css')}}">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
        @page {
            size: A5 landscape;
            margin: 0;
        }
        body {
            min-width: initial !important;
        }

        p1 {font-size: 0.75em; /* 14px/16=0.875em */}
        th {font-size: 0.75em;}
        td {font-size: 0.75em;}
  </style>
</head>

<body class="A5 landscape">
  <section class="sheet padding-10mm">
    <div class="row">
        <div class="col text-left">
            <p1>PT. Rajawali Aluminium Perkasa<br>Jl. Kima 16 Kav DD 7,<br>Makassar, Sulawesi Selatan</p>
        </div>
        <div class="col text-right">
            <p1 class="text-right">{{ $pembelianav->nomor }}<br>{{ $pembelianav->tanggal }}<br>{{ $pembelianav->created_by }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5 class="text-center">Pembelian Avalan</h5>
            <div class="row">
                <div class="col">
                    <p1>Nama Supplier : {{ $pembelianav->supplier->nama }}<br>{{ $pembelianav->supplier->alamat }}</p>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Avalan</th>
                                            <th>Qty</th>
                                            <th>Potongan</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total=0; $subtotal=0  ?>
                                        @foreach ($pembelianavdetail as $key=>$value)
                                        <tr>
                                            <?php $subtotal=$value->qty*$value->harga ?>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->avalan->nama }}</td>
                                            <td>{{ number_format($value->qty) }}</td>
                                            <td>{{ $value->potongan }}</td>
                                            <td>{{ number_format($value->harga) }}</td>
                                            <td>{{ number_format($subtotal) }}</td>
                                        </tr>
                                        <?php $total += $subtotal  ?>
                                        @endforeach                                        
                                        <tr>
                                            <td class="text-left border-secondary" colspan="4">Terbilang : {{ ucwords(terbilang($total)) }} Rupiah</td>
                                            <td class="text-right border-secondary">Total</td>
                                            <td class="border-secondary">{{ number_format($total) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="text-center" style="margin-top: 10px;">Penerima</p>
                                </div>
                                <div class="col">
                                    <p class="text-center" style="margin-top: 10px;">PT. Rajawali Aluminium Perkasa</p>
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