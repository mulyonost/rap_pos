<!DOCTYPE html>
<html style="border-style: none;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SJ</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<style>
	.table th {
    border-bottom: 1px solid #000000;
}
</style>


<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <p style="margin-top: 30px;">PT. Aluminium Indojaya Perkasa<br>Jl. Kima 16 KAV DD 7<br>Makassar, Sulawesi Selatan</p>
            </div>
            <div class="col">
                <p style="text-align: right;margin-top: 30px;">{{ $penjualan->nomor }}<br>{{ $penjualan->tanggal}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p style="text-align: center;font-size: 35px;">SURAT JALAN</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>{{ $penjualan->customer->nama }}<br>{{ $penjualan->customer->alamat }}</p>
            </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No.</th>
                                <th>Nama Barang</th>
                                <th style="width: 77px;">Colly</th>
                                <th style="width: 77px;">Isi</th>
                                <th style="width: 173px;">Total Btg</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php $total = 0; $batang = 0 ?>
							@foreach ($penjualandetail as $key => $value)
                            <tr>
								<td>{{ $key+1 }}</td>
                                <td>{{ $value->aluminium->nama }}</td>
                                <td>{{ $value->colly }}</td>
                                <td>{{ $value->isi }} </td>
                                <td>{{ number_format($value->qty) }}</td>
                                <td>{{ $value->colly }} @ {{ $value->isi }}</td>
								<?php  $total += $value->colly; ?>
								<?php  $batang += $value->qty; ?>
                            </tr>
							@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row" style="border-top-style: solid;">
            <div class="col"></div>
            <div class="col-xl-5">
                <p style="text-align: left;">Total Colly <?php echo $total;  ?>  Colly<br>Total Batang <?= number_format($batang) ?> Batang</p>
            </div>
        </div>
        <div class="row">
            <div class="col" style="border-style: none;">
                <p style="text-align: center;">Penerima</p>
            </div>
            <div class="col">
                <p style="text-align: center;">Pemeriksa<br></p>
            </div>
            <div class="col-xl-5"></div>
        </div>
        <div class="row" style="border-top-style: none;">
            <div class="col">
                <p style="text-align: center;margin-top: 50px;">(____________)</p>
            </div>
            <div class="col">
                <p style="text-align: center;margin-top: 50px;">(____________)<br><br></p>
            </div>
            <div class="col-xl-5"></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>