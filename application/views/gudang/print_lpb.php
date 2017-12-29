<!doctype html>

<head>
  <title>Print LPB</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/print_lpb.css">
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/gudang.js"></script>
</head>

<body>
	<p class="title">PT. Hisamitsu Pharma Indonesia</p>
	<div class="left-item">
		<p>No. LPB: Test</p>
		<p>Tanggal Terima: Test</p>
		<p>No. Surat Pesanan: Test</p>
	</div>
	<div class="right-item">
		<p>Nama Supplier: Test</p>
		<p>Nama Manufacturer: Test</p>
	</div>
	<table class="content-item table table-bordered table-responsive">
		<thead>
	        <tr>
		        <th>Kode</th>
		        <th>Nama Bahan</th>
		        <th>No. Batch</th>
		        <th>Jumlah</th>
		    </tr>
		</thead>
		<tbody>
		    <tr>
		        <td>Test</td>
		        <td>Test</td>
		        <td>Test</td>
		        <td>Test</td>
		    </tr>
		</tbody>
	</table>
	<p class="right-item sign">Signed By (Electronic Sign)</p>
	<div class="button-container">
		<form class="button-item" action="gudang.html"><button type="button submit" class="btn" id="back">Back</button></form>
		<form class="button-item" action="gudang.html"><button type="button submit" class="btn" id="print">Print</button></form>
	</div>
</body>