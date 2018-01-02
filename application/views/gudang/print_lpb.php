<!doctype html>

<head>
  <title>Print LPB</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/print_lpb.css">
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/lpb.js"></script>
</head>

<body>
	<div id="print-content">
		<p class="title">PT. Hisamitsu Pharma Indonesia</p>
		<div class="left-item">
			<p>No. LPB: <?php echo $lpb[0]['Nomor_LPB']?></p>
			<p>Tanggal Terima: <?php echo $lpb[0]['Tanggal_Terima']?></p>
			<p>No. Surat Pesanan: <?php echo $lpb[0]['Nomor_Surat']?></p>
		</div>
		<div class="right-item">
			<p>Nama Supplier: <?php echo $lpb[0]['Nama_Supplier']?></p>
			<p>Nama Manufacturer: <?php echo $lpb[0]['Nama_Manufacturer']?></p>
		</div>
		<?php
		$template = array(
		    'table_open'            => '<table class="content-item table table-bordered table-responsive">'
			);
			$this->table->set_template($template);
			$this->table->set_heading('Kode', 'Nama Bahan', 'Nomor Batch', 'Jumlah', 'Satuan');

			foreach ($lpb_batch as $row) {
				$this->table->add_row( $lpb[0]['Kode_Bahan'], $lpb[0]['Nama_Bahan'], $row['Nomor_Batch'], $row['Jumlah'], $lpb[0]['Satuan']);
			}
			echo $this->table->generate();
	 	?>

		<p class="right-item sign">Signed By (Electronic Sign)</p>
	</div>

	<div class="button-container">
		<button onclick="printThis()" type="button" class="button-item btn" id="print">Print</button>
		<button onclick="location.href='<?php echo base_url();?>gudang'" type="button" class="button-item btn" id="back">Kembali</button>
		<br>
	</div>

	<script type="text/javascript">
		function printThis() {
			$('.button-container').hide();
			window.print();
			$('.button-container').show();
		}
	</script>
</body>