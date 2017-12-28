<!doctype html>

<head>
  <title>Hasil Pemeriksaan Bahan Awal</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/print-lpb.css">
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/gudang.js"></script>
</head>

<body>
	<p class="title">PT. Hisamitsu Pharma Indonesia</p>
	<?php
		echo "<div class='error_msg'>";
		echo validation_errors();
		echo "</div>";

		if (isset($message_display)) {
			echo "<div class='message'>";
			echo $message_display;
			echo "</div>";
		}
		
		echo "<div class='left-item'>";
			foreach ($bahan as $row) {
				echo "<p>";
				echo form_label('Nomor LPB :');
				//echo form_hidden('lpb', $row['Nomor_LPB']);
				echo ' ';
				echo $row['Nomor_LPB'];
				echo"<br/>";
			}
			foreach ($hasil as $row) {
				echo form_label('Nomor Analisa :');
				echo ' ';
				echo $row['Nomor_Analisa'];
				echo"<br/>";
				break;
			}
			foreach ($bahan as $row) {
				echo form_label('Tanggal Terima :');
				echo ' ';
				echo $row['Tanggal_Terima'];
				echo"<br/>";
			}
			foreach ($sampel as $row) {
				echo form_label('Tanggal Pemeriksaan :');
				echo ' ';
				echo $row['Tanggal_Pemeriksaan'];
				echo"<br/>";
				echo "</p>";
			}
		echo "</div>";

		echo "<div class='right-item'>";
			foreach ($bahan as $row) {
				echo "<p>";
				echo form_label('Kode Bahan Baku:');
				echo ' ';
				echo $row['Kode_Bahan'];
				echo"<br/>";
				echo form_label('Nama Bahan Baku:');
				echo ' ';
				echo $row['Nama_Bahan'];
				echo"<br/>";
				echo form_label('Nomor Batch :');
				echo ' ';
				$a = $row['Nomor_LPB'];
				echo $batch[$a];
				echo"<br/>";
			}
			foreach ($sampel as $row) {
				# code...
				echo form_label('Sisa Pertinggal :');
				echo ' ';
				echo $row['Sisa_Sampel'];
				echo"<br/>";
				echo "</p>";
			}
		echo "</div>";

		$template = array(
	        'table_open'            => '<table class="content-item table table-bordered table-responsive">'
		);
		$this->table->set_template($template);

		$this->table->set_heading('No', 'Parameter', 'Spesifikasi', 'Hasil');
		
		$i = 0;
		foreach ($param as $row) {
			//$a = $row->No;
			$h = $hasil[$i]['Hasil'];
			$this->table->add_row($row->No, $row->Parameter, $row->Spesifikasi, $h);
			$i++;
		}
		echo $this->table->generate();
	?>
	<!--<p class="right-item sign">Signed By (Electronic Sign)</p>-->
	<div class="button-container">
		<button onclick="location.href='<?php echo base_url();?>ka_quality_control'" type="button" class="btn" id="tambah">HOLD</button>
		<button onclick="location.href='<?php echo base_url();?>ka_quality_control/reject_bahan/<?php echo $a;?>'" type="button" class="btn" id="back">REJECT</button>
		<button onclick="location.href='<?php echo base_url();?>ka_quality_control/release_bahan/<?php echo $a;?>'" type="button" class="btn" id="print">RELEASE</button>
	</div>
</body>