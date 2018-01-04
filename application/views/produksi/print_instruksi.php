<!doctype html>

<head>
  <title>Print Permintaan Bahan Baku</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/print_lpb.css">
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/produksi.js"></script>
    <!--Print JS
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/print.min.css">
    <script src="<?php echo base_url(); ?>public/js/print.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
</head>

<body>
	<div id="print-content">
		<p class="title">PT. Hisamitsu Pharma Indonesia</p>
		<div class="left-item">
			<p>No. Instuksi: <?php echo $ins[0]['Nomor_Instruksi']?></p>
			<p>Site Produksi: <?php echo $ins[0]['Site_Produksi']?></p>
			<p>Tanggal Permintaan: <?php echo $ins[0]['Tanggal_Permintaan']?></p>
		</div>
		<!--<div class="right-item">
			<p>Nama Supplier: <?php //echo $lpb[0]['Nama_Supplier']?></p>
			<p>Nama Manufacturer: <?php //echo $lpb[0]['Nama_Manufacturer']?></p>
		</div>-->
		<?php
		$template = array(
		    'table_open'            => '<table class="content-item table table-bordered table-responsive">'
			);
			$this->table->set_template($template);
			$this->table->set_heading('Kode Bahan', 'Nomor Analisa', 'Jumlah', 'Keterangan');

			foreach ($ins_bahan as $row) {
				$this->table->add_row( $row['Kode_Bahan'], $row['Nomor_Analisa'], $row['Jumlah'], $row['Keterangan']);
			}
			echo $this->table->generate();
	 	?>

		<p class="left-item sign">Signed By (Admin Gudang)</p>
		<p class="right-item sign">Signed By (Penerima)</p>
	</div>

	<div class="button-container">
		<button onclick="printThis()" type="button" class="button-item btn" id="print">Print</button>
		<button onclick="location.href='<?php echo base_url();?>produksi'" type="button" class="button-item btn" id="back">Kembali</button>
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