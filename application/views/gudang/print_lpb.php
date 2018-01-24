<!doctype html>

<head>
	<title>Print LPB</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- jQuery library -->
	<script src="<?php echo base_url(); ?>public/js/jquery-3.2.1.min.js"></script>
	<!--Bootstrap 4-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
	<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
	<!--Icons-->
	<script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
	<!--Our Custom CSS & JS-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/global.css">
	<script src="<?php echo base_url(); ?>public/js/global.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/lpb.css">
    <script src="<?php echo base_url(); ?>public/js/lpb.js"></script>
</head>

<body>
	<div id="print-content">
		<p class="title print-only" style="display: none;">PT. Hisamitsu Pharma Indonesia</p>
		<br>
		<div class="row">
			<div class="col-md-4 offset-md-1">
				<p><a class="font-weight-bold">No. LPB:</a> <?php echo $lpb[0]['Nomor_LPB']?></p>
				<p><a class="font-weight-bold">Tanggal Terima:</a> <?php echo $lpb[0]['Tanggal_Terima']?></p>
				<p><a class="font-weight-bold">No. Surat Pesanan:</a> <?php echo $lpb[0]['Nomor_Surat']?></p>
			</div>
			<div class="col-md-4 offset-md-2">
				<p><a class="font-weight-bold">Nama Supplier:</a> <?php echo $lpb[0]['Nama_Supplier']?></p>
				<p><a class="font-weight-bold">Nama Manufacturer:</a> <?php echo $lpb[0]['Nama_Manufacturer']?></p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-10 offset-md-1">
			<?php
			$template = array(
			    'table_open' => '<table class="table table-bordered" cell-spacing="0">'
				);
				$this->table->set_template($template);
				$this->table->set_heading('Kode', 'Nama Bahan', 'Nomor Batch', 'Jumlah', 'Satuan');

				foreach ($lpb_batch as $row) {
					$this->table->add_row( $lpb[0]['Kode_Bahan'], $lpb[0]['Nama_Bahan'], $row['Nomor_Batch'], $row['Jumlah'], $lpb[0]['Satuan']);
				}
				echo $this->table->generate();
		 	?>
			</div>
		</div>

		<p class="right-item sign print-only" style="display: none;">Signed By (Electronic Sign)</p>
	</div>

	<div class="button-container mt-3">
		<button onclick="printThis()" type="button" class="button-item btn" id="print">Print</button>
		<button onclick="location.href='<?php echo base_url();?>gudang'" type="button" class="button-item btn" id="back">Kembali</button>
		<br>
	</div>

	<script type="text/javascript">
		function printThis() {
			$('.button-container').hide();
			$('.print-only').show();
			window.print();
			$('.button-container').show();
			$('.print-only').hide();
		}
	</script>
</body>