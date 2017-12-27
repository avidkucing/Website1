<!doctype html>

<head>
  <title>Tambah Instruksi Pemeriksaan Sampel Bahan</title>
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
		
		echo form_open('quality_control/new_instruksi_bahan');
		
		echo "<div class='left-item'>";
			echo "<p>";
			echo form_label('No. Instruksi :');
			echo ' ';
			echo form_input('no_ins');
			echo "</p>";
			echo"<br/>";
			echo "<p>";
			$date1 = array(
		        'type'          => 'date',
		        'name'          => 'tgl',
			);
			echo form_label('Tanggal Instruksi :');
			echo ' ';
			echo form_input($date1);
			echo "</p>";
			echo"<br/>";
			echo "<p>";
			$date2 = array(
		        'type'          => 'date',
		        'name'          => 'tgl2',
			);
			echo form_label('EXP Date :');
			echo ' ';
			echo form_input($date2);
			echo "</p>";
			$coa = array(
				1 => 'ADA',
				0 => 'TIDAK ADA'
			);
			echo form_label('COA :');
			echo ' ';
			echo form_dropdown('coa', $coa);
			echo "</p>";
			echo "<p>";
			echo form_label('Pola Sampling :');
			echo ' ';
			$pola = array(
				'POLA n(1+(N)^-1/2)' => 'POLA n(1+(N)^-1/2)',
				'POLA p (bahan baku homogen, semua wadah)' => 'POLA p (bahan baku homogen, semua wadah)',
				'POLA r (beban baku tidak homogen/tidak terkualifikasi, semua wadah)' => 'POLA r (beban baku tidak homogen/tidak terkualifikasi, semua wadah)'
			);
			echo form_dropdown('pola', $pola);
			echo "</p>";
			echo"<br/>";
			echo "<p>";
			echo form_label('Jumlah Wadah yang Disampling :');
			echo ' ';
			echo form_input('wadah');
			echo "</p>";
			echo"<br/>";
			echo "<p>";
			echo form_label('Jumlah Sampel:');
			echo ' ';
			echo form_input('jumlah');
			echo "</p>";
			echo"<br/>";
			echo "<p>";
			echo form_label('Petugas Sampling :');
			echo ' ';
			echo form_input('petugas');
			echo "</p>";
			echo"<br/>";
			echo "<p>";
			echo form_label('Rencana Pemeriksaan Sampel :');
			echo ' ';
			$rencana = array(
				'FULL TEST' => 'FULL TEST',
				'SKIP TEST' => 'SKIP TEST',
				'LAIN_LAIN' => 'LAIN_LAIN'
			);
			echo form_dropdown('rencana', $rencana);
			echo "</p>";
			echo"<br/>";
			echo "<p>";
			echo form_label('Catatan :');
			echo ' ';
			echo form_input('catatan');
			echo "</p>";
			echo"<br/>";
			
		echo "</div>";

		echo "<div class='right-item'>";
			foreach ($bahan as $row) {
				echo "<p>";
				echo form_label('Nama Bahan :');
				echo ' ';
				echo $row['Nama_Bahan'];
				echo"<br/>";
				echo form_label('Kode Bahan :');
				echo ' ';
				echo $row['Kode_Bahan'];
				echo"<br/>";
				echo form_label('Merk :');
				echo ' ';
				echo $row['Merk'];
				echo"<br/>";
				echo form_label('Pabrik Pembuat :');
				echo ' ';
				echo $row['Nama_Manufacturer'];
				echo"<br/>";
				echo form_label('Pemasok :');
				echo ' ';
				echo $row['Nama_Supplier'];
				echo"<br/>";
				echo form_label('Tanggal Terima :');
				echo ' ';
				echo $row['Tanggal_Terima'];
				echo"<br/>";
				echo form_label('Nomor Batch :');
				echo ' ';
				$a = $row['Nomor_LPB'];
				echo $batch[$a];
				echo"<br/>";
				echo form_label('Jumlah Terima :');
				echo ' ';
				echo $row['Jumlah'];
				echo"<br/>";
				echo form_label('Nomor LPB :');
				echo form_hidden('lpb', $row['Nomor_LPB']);
				echo ' ';
				echo $row['Nomor_LPB'];
				echo"<br/>";
				echo "</p>";				
			}
		echo "</div>";
	?>
	<!--<p class="right-item sign">Signed By (Electronic Sign)</p>-->
	<div class="button-container">
		<button onclick="location.href='<?php echo base_url();?>quality_control'" type="button" class="btn" id="back">Back</button>
		<button type="button submit" class="btn" id="tambah">Tambah</button>
		<!--<form class="button-item" action="gudang.html"><button type="button submit" class="btn" id="print">Print</button></form>-->
	</div>
	<?php
		echo form_close();
	?>
</body>