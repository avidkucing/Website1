<!doctype html>

<head>
  <title>Hasil Pemeriksaan Bahan Awal</title>
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
			foreach ($analisa as $row) {
				echo form_label('Tanggal Pemeriksaan :');
				echo ' ';
				echo $row['Tanggal_Pemeriksaan'];
				echo"<br/>";
			}
			foreach ($bahan as $row) {
				echo form_label('Nama Manufacturer :');
				echo ' ';
				echo $row['Nama_Manufacturer'];
				echo"<br/>";
			}
			foreach ($bahan as $row) {
				echo form_label('Nama Supplier :');
				echo ' ';
				echo $row['Nama_Supplier'];
				echo"<br/>";
							}
			foreach ($analisa as $row) {
				echo form_label('Merk :');
				echo ' ';
				echo $row['Merk'];
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
			}
			foreach ($batch as $row) {
				echo form_label('Nomor Batch :');
				echo ' ';
				echo $row['Nomor_Batch'];
				$a = $row['ID_Batch']; // untuk release/reject
				echo"<br/>";
			}
			foreach ($analisa as $row) {
				echo form_label('Sisa Pertinggal :');
				echo ' ';
				echo $row['Sisa_Sampel'];
				echo"<br/>";
			}
			foreach ($sampel as $row) {
				echo form_label('Jumlah Sampel :');
				echo ' ';
				echo $row['Jumlah_Sampel'];
				echo"<br/>";
			}
			foreach ($batch as $row) {
				echo form_label('EXP. Date :');
				echo ' ';
				echo $row['EXP_Date'];
				echo"<br/>";
			}
			foreach ($batch as $row) {
				echo form_label('Keterangan :');
				echo ' ';
				echo $row['Keterangan'];
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
			$h = $hasil[$i]['Hasil'];
			$this->table->add_row($row->No, $row->Parameter, $row->Spesifikasi, $h);
			$i++;
		}
		echo $this->table->generate();

		echo form_open('ka_quality_control/fix_status');
		$input_attr = array('class' => 'form-control input-sm');
		$teks = array('type' => 'text', 'name' => 'alasan', 'rows' => '2',);
		$label_attr = array('class' => 'col-form-label col-sm-6');
		echo "<div class='col-sm-6'>";
		echo form_label('Alasan Pengubahan Status', '', $label_attr);
		echo form_textarea($teks, '', $input_attr);
		echo "<br>";
		$options = array('QUARANTINE' => 'QUARANTINE', 'RELEASE' => 'RELEASE', 'REJECT' => 'REJECT');
		echo form_label('Status', '', $label_attr);
		echo form_dropdown('status', $options, '', 'class="form-control"');
		echo "</div>";
		echo form_hidden('bat', $a);

	?>
	
	<div class="button-container">
		<button type="button submit" class="btn" id="print">SUBMIT</button>
		<button onclick="location.href='<?php echo base_url();?>ka_quality_control'" type="button" class="btn" id="tambah">HOLD</button>
	</div>

	<?php
		echo form_close();
	?>
</body>