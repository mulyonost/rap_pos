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
            <p1>PT. Aluminium<br>Jl. Kima 16 Kav DD 7<br>Makassar, Sulawesi Selatan</p>
        </div>
        <div class="col text-right">
            <p1 class="text-right">{{ $pembelianav->nomor }}<br>{{ \Carbon\Carbon::parse($pembelianav->tanggal)->format('d-M-Y')}}<br>{{ $pembelianav->created_by }}</p>
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
                                <table class="table table-sm tbl-avalan">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="20%">Nama Avalan</th>
                                            <th width="15%">Qty</th>
                                            <th width="10%">Potongan</th>
                                            <th width="15%">Qty Akhir</th>
                                            <th width="15%">Harga</th>
                                            <th width="20%">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total=0; $subtotal=0  ?>
                                        @foreach ($pembelianavdetail as $key=>$value)
                                        <tr>
                                            <?php $subtotal=($value->qty-$value->potongan)*$value->harga ?>
                                            <td>{{ $key+1 }}</td>
                                            <td class="text-center">{{ $value->avalan->nama }}</td>
                                            <td class="number">{{ number_format($value->qty) }} Kg</td>
                                            <td class="number">{{ $value->potongan }} Kg</td>
                                            <td class="number">{{ ($value->qty_akhir) }} Kg</td>
                                            <td class="number">Rp. {{ number_format($value->harga) }}</td>
                                            <td class="number">Rp. {{ number_format($value->subtotal) }}</td>
                                        </tr>
                                        <?php $total += $subtotal  ?>
                                        @endforeach                                        
                                        <tr>
                                            <td class="text-left border-secondary" colspan="5">Terbilang : {{ ucwords(terbilang($pembelianav->total_nota)) }} Rupiah</td>
                                            <td class="text-right border-secondary"><b>Total</b></td>
                                            <td class="border-secondary number"><b>Rp. {{ number_format($pembelianav->total_nota) }} </b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Jatuh Tempo : {{ \Carbon\Carbon::parse($pembelianav->due_date)->format('d-M-Y')}}</td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="text-center" style="margin-top: 10px;">Penerima</p>
                                </div>
                                <div class="col">
                                    <p class="text-center" style="margin-top: 10px;">PT. Aluminium</p>
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