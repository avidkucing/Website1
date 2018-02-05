<!doctype html>

<head>
	<title>Tambah Instruksi Pemeriksaan Sampel Bahan</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/instruksi.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/qc-form.js"></script>
    <!--Icons-->
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <!--Bootstrap 4-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<p class="title">INSTRUKSI SAMPLING DAN PENGISIAN BAHAN BAKU</p>
		<?php
			echo "<div class='error_msg'>";
			echo validation_errors();
			echo "</div>";

			if (isset($message_display)) {
				echo "<div class='message'>";
				echo $message_display;
				echo "</div>";
			}
			
			echo form_open('ka_quality_control/new_instruksi_bahan');
			
			echo "<div class='row'>";
				echo "<div class='form-group col-sm-4 row'>";
				$label_attr = array('class' => 'col-form-label col-sm-5');
				echo form_label('No. Instruksi:', '', $label_attr);
					echo "<div class='col-sm-7'>";
					$input_attr = array('class' => 'form-control input-sm', 'pattern' => '[0-9]+/ISP-BA+/[0-9]{4}');
					echo form_input('no_ins', '', $input_attr);
					echo "</div>";
				echo "</div>";
				echo "<div class='col-sm-2'>";
				echo "</div>";
				echo "<div class='form-group col-sm-6 row'>";
					$label_attr = array('class' => 'col-form-label col-sm-3');
					echo form_label('Jumlah Sampel', '', $label_attr);
					echo "<div class='col-sm-9'>";
					$input_attr = array('class' => 'form-control input-sm');
					echo form_input('jumlah', '', $input_attr);
				echo "</div>";
			echo "</div>";

				/*
				echo "<div class='col-sm-2'>";
				echo "</div>";
				echo "<div class='form-group col-sm-6 row'>";
				$date1 = array(
				        'type'          => 'date',
				        'name'          => 'tgl',
					);
				$label_attr = array('class' => 'col-form-label col-sm-4');
				echo form_label('Tanggal Instruksi:', '', $label_attr);
					echo "<div class='col-sm-7'>";
					$input_attr = array('class' => 'form-control input-sm');
					echo form_input($date1, '', $input_attr);
					echo "</div>";
				echo "</div>";
				*/
			echo "</div>";

			echo "<hr>";
			//print_r($batch);
			foreach ($bahan as $row) {
				echo "<div class='form-group row'>";
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Nama Bahan', '', $label_attr);
					echo "<div class='col-sm-9'>";
					echo "<input type='text' readonly class='form-control-plaintext' value=': ",$row['Nama_Bahan'],"'>";
					echo "</div>";
				echo "</div>";
				
				echo "<div class='form-group row'>";
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Kode Bahan', '', $label_attr);
					echo "<div class='col-sm-9'>";
					echo "<input type='text' readonly class='form-control-plaintext' value=': ",$row['Kode_Bahan'],"'>";
					echo "</div>";
				echo "</div>";

				/*echo "<div class='form-group row'>";
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Merk', '', $label_attr);
					echo "<div class='col-sm-9'>";
					echo "<input type='text' readonly class='form-control-plaintext' value=': ",$row['Merk'],"'>";
					echo "</div>";
				echo "</div>";
				*/
				echo "<div class='form-group row'>";
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Pabrik Pembuat', '', $label_attr);
					echo "<div class='col-sm-9'>";
					echo "<input type='text' readonly class='form-control-plaintext' value=': ",$row['Nama_Manufacturer'],"'>";
					echo "</div>";
				echo "</div>";

				echo "<div class='form-group row'>";
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Pemasok', '', $label_attr);
					echo "<div class='col-sm-9'>";
					echo "<input type='text' readonly class='form-control-plaintext' value=': ",$row['Nama_Supplier'],"'>";
					echo "</div>";
				echo "</div>";

				echo "<div class='form-group row'>";
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Tanggal Terima', '', $label_attr);
					echo "<div class='col-sm-9'>";
					echo "<input type='text' readonly class='form-control-plaintext' value=': ",$row['Tanggal_Terima'],"'>";
					echo "</div>";
				echo "</div>";

				echo "<div class='form-group row'>";
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Nomor Batch', '', $label_attr);
				$a = $row['Nomor_LPB']; //ini buat apa bib?
					echo "<div class='col-sm-9'>";
					echo "<input type='text' readonly class='form-control-plaintext' value=': ",$batch[0]['Nomor_Batch'],"'>";
					echo "</div>";
				echo "</div>";

				echo "<div class='form-group row'>";
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Jumlah Terima', '', $label_attr);
					echo "<div class='col-sm-9'>";
					echo "<input type='text' readonly class='form-control-plaintext' value=': ",$batch[0]['Jumlah'],"'>";
					echo "</div>";
				echo "</div>";

				echo "<div class='form-group row'>";
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Nomor LPB', '', $label_attr);
				echo form_hidden('bat', $batch[0]['ID_Batch']);
					echo "<div class='col-sm-9'>";
					echo "<input type='text' readonly class='form-control-plaintext' value=': ",$row['Nomor_LPB'],"'>";
					echo "</div>";
				echo "</div>";
			}
			/*
			echo "<div class='form-group row'>";
				$date2 = array(
			        'type'          => 'date',
			        'name'          => 'tgl2',
				);
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('EXP. Date', '', $label_attr);
					echo "<div class='col-sm-9'>";
					$input_attr = array('class' => 'form-control input-sm');
					echo form_input($date2, '', $input_attr);
					echo "</div>";
			echo "</div>";

			echo "<div class='form-group row'>";
				$coa = array(
					1 => 'ADA',
					0 => 'TIDAK ADA'
				);
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('COA', '', $label_attr);
					echo "<div class='col-sm-9'>";
					$input_attr = array('class' => 'form-control input-sm');
					echo form_dropdown('coa', $coa, 1, $input_attr);
					echo "</div>";
			echo "</div>";

			echo "<hr>";

			echo "<p class='subtitle'>RENCANA PENGAMBILAN SAMPEL</p>";

			echo "<div class='form-group row'>";
				$pola = array(
					'POLA n(1+(N)^-1/2)' => 'POLA n(1+(N)^-1/2)',
					'POLA p (bahan baku homogen, semua wadah)' => 'POLA p (bahan baku homogen, semua wadah)',
					'POLA r (beban baku tidak homogen/tidak terkualifikasi, semua wadah)' => 'POLA r (beban baku tidak homogen/tidak terkualifikasi, semua wadah)'
				);
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Pola Sampling', '', $label_attr);
					echo "<div class='col-sm-9'>";
					$input_attr = array('class' => 'form-control input-sm');
					echo form_dropdown('pola', $pola, 'POLA n(1+(N)^-1/2)', $input_attr);
					echo "</div>";
			echo "</div>";

			echo "<div class='form-group row'>";
			$label_attr = array('class' => 'col-form-label col-sm-3');
			echo form_label('Jumlah Wadah yang Disampling', '', $label_attr);
				echo "<div class='col-sm-9'>";
				$input_attr = array('class' => 'form-control input-sm');
				echo form_input('wadah', '', $input_attr);
				echo "</div>";
			echo "</div>";

			echo "<div class='form-group row'>";
			$label_attr = array('class' => 'col-form-label col-sm-3');
			echo form_label('Jumlah Sampel', '', $label_attr);
				echo "<div class='col-sm-9'>";
				$input_attr = array('class' => 'form-control input-sm');
				echo form_input('jumlah', '', $input_attr);
				echo "</div>";
			echo "</div>";

			echo "<div class='form-group row'>";
			$label_attr = array('class' => 'col-form-label col-sm-3');
			echo form_label('Petugas Sampling', '', $label_attr);
				echo "<div class='col-sm-9'>";
				$input_attr = array('class' => 'form-control input-sm');
				echo form_input('petugas', '', $input_attr);
				echo "</div>";
			echo "</div>";

			echo "<div class='form-group row'>";
				$rencana = array(
					'FULL TEST' => 'FULL TEST',
					'SKIP TEST' => 'SKIP TEST',
					'LAIN_LAIN' => 'LAIN_LAIN'
				);
				$label_attr = array('class' => 'col-form-label col-sm-3');
				echo form_label('Rencana Pemeriksaan Sampel', '', $label_attr);
					echo "<div class='col-sm-9'>";
					$input_attr = array('class' => 'form-control input-sm');
					echo form_dropdown('rencana', $rencana, 'FULL TEST', $input_attr);
					echo "</div>";
			echo "</div>";

			echo "<div class='form-group row'>";
			$label_attr = array('class' => 'col-form-label col-sm-3');
			echo form_label('Catatan', '', $label_attr);
				echo "<div class='col-sm-9'>";
				$input_attr = array('class' => 'form-control input-sm', 'rows' => '3');
				echo form_textarea('catatan', '', $input_attr);
				echo "</div>";
			echo "</div>";
			*/
		?>

		<!--<p class="right-item sign">Signed By (Electronic Sign)</p>-->
		<div class="button-container">
			<button onclick="location.href='<?php echo base_url();?>ka_quality_control'" type="button" class="btn" id="back">Back</button>
			<button type="button submit" class="btn" id="tambah">Tambah</button>
			<!--<form class="button-item" action="gudang.html"><button type="button submit" class="btn" id="print">Print</button></form>-->
		</div>
		<?php
			echo form_close();
		?>
	</div>
</body>