<!doctype html>

<head>
  <title>Print Permintaan Bahan Baku</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/print_lpb.css">
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/gudang.js"></script>
    <!--Print JS
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/print.min.css">
    <script src="<?php echo base_url(); ?>public/js/print.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
</head>

<body>
	<div id="print-content">
		<p class="title">PT. Hisamitsu Pharma Indonesia</p>
		<div class="left-item">
			<p>No. Instruksi: <?php echo $ins[0]['Nomor_Instruksi']?></p>
			<p>Site Produksi: <?php echo $ins[0]['Site_Produksi']?></p>
			<p>Tanggal Permintaan: <?php echo $ins[0]['Tanggal_Permintaan']?></p>
			<br>
		</div>
		<!--<div class="right-item">
			<p>Nama Supplier: <?php //echo $lpb[0]['Nama_Supplier']?></p>
			<p>Nama Manufacturer: <?php //echo $lpb[0]['Nama_Manufacturer']?></p>
		</div>-->
		<?php
		$form_attr = array('class' => 'form-horizontal', 'role' => 'form');
		form_open('gudang/insert_analisa_bahan_minta', $form_attr);
		
		$template = array(
		    'table_open'            => '<table class="content-item table table-bordered table-responsive">'
			);
			$this->table->set_template($template);
			$this->table->set_heading('Kode Bahan', 'Nomor Analisa', 'Jumlah', 'Status', 'Keterangan');
			$arr_no_ana = $this->gudang_database->get_data_nomor_analisa($jenis_bahan[0]['Kode_Bahan']);

			foreach ($ins_bahan as $row) {
				foreach ($jenis_bahan as $rowb) {
					if ($row['Kode_Bahan'] == $rowb['Kode_Bahan']) {
						$this->table->add_row( $row['Kode_Bahan'], my_form_dropdown('no_ana[]', $arr_no_ana,'', '', '', 'class="form-control"'), $row['Jumlah'], $rowb['Satuan'], $row['Keterangan']);		
					}
					
				}
				
			}
			echo $this->table->generate();
			form_hidden('no_ins', $ins[0]['Nomor_Instruksi']);
			$arr_jum = array();
			foreach ($ins_bahan as $row) {
				$arr_jum = array_merge($arr_jum, (array)$row['Jumlah']);
			}
			//print_r($arr_jum);
			form_hidden('jum[]', $arr_jum);
	 	?>

		<p class="left-item sign">Signed By (Admin Gudang)</p>
		<p class="right-item sign">Signed By (Penerima)</p>
	</div>

	<div class="button-container">
		<button type="button submit" class="btn" id="confirm">Konfirmasi</button>
		<button onclick="printThis()" type="button" class="button-item btn" id="print">Print</button>
		<button onclick="location.href='<?php echo base_url();?>gudang'" type="button" class="button-item btn" id="back">Kembali</button>
		<br>
	</div>

	<?php
		echo form_close();
	?>

	<script type="text/javascript">
		function printThis() {
			$('.button-container').hide();
			window.print();
			$('.button-container').show();
		}
	</script>
</body>