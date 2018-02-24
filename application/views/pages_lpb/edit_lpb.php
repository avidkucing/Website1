<!doctype html>

<head>
	<title>Edit LPB</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- jQuery library -->
	<script src="<?php echo base_url(); ?>public/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url(); ?>public/js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.min.css">
	<!--Bootstrap 4-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
	<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
	<!--Icons-->
	<script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
	<!--Our Custom CSS & JS-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/global.css">
	<script src="<?php echo base_url(); ?>public/js/global.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/edit-lpb.css">
    <script src="<?php echo base_url(); ?>public/js/edit-lpb.js"></script>
</head>

<body>
	<?php
		echo "<div class='error_msg'>";
		echo validation_errors();
		echo "</div>";

		if (isset($message_display)) {
			echo "<div class='message'>";
			echo $message_display;
			echo "</div>";
		}
	?>

	<h1 class="text-center p-3">Edit LPB</h1>

	<?php	
		$form_attr = array('class' => 'form-horizontal');
		echo form_open('', $form_attr);
	
		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('No. LPB:', '', $label_attr);
			echo "<div class='col-sm-8'>";
			$input_attr = array('class' => 'form-control nolpb', 'disabled' => '');
			echo form_input('lpb', $lpb[0]['Nomor_LPB'], $input_attr);
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('Tgl Terima:', '', $label_attr);
			echo "<div class='col-sm-8'>";
			$input_attr = array('class' => 'form-control tglterima', 'pattern' => '\d\d/\d\d/\d{4}', 'title' => 'DD/MM/YYYY', 'required' => '');
			echo form_input('tgl', $lpb[0]['Tanggal_Terima'], $input_attr);
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('No. Surat Pesanan:', '', $label_attr);
			echo "<div class='col-sm-8'>";
			$input_attr = array('class' => 'form-control', 'disabled' => '', 'required' => '');
			echo form_input('surat', $lpb[0]['Nomor_Surat'], $input_attr);
			echo "</div>";
		echo "</div>";

		//opsi bahan
		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'control-label col-sm-2 offset-sm-1');
		echo form_label('Jenis Bahan:', '', $label_attr);
			echo "<div class='col-sm-8'>";
			$jenis_bahan = array ('' => '--Pilih Opsi Jenis Bahan--', 'Baku' => 'Bahan Baku', 'Kemas' => 'Bahan Kemas', 'Pembantu' => 'Bahan Pembantu');
			echo my_form_dropdown('jenis', $jenis_bahan, $lpb[0]['Jenis'], '', '', 'class="form-control jenisbahan"'); 
			echo "</div>";
		echo "</div>";

		//get object return from gudang database model & initial array kosong untuk form
		//$kode_rows = $this->gudang_database->get_kode_bahan();
		$kode_rows = array();
		
		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'control-label col-sm-2 offset-sm-1');
		echo form_label('Kode Bahan:', '', $label_attr);
			echo "<div class='col-sm-8'>";
			$dump_kode = array ('' => '--Pilih Opsi Jenis Bahan Dulu--');
			$kode_rows = $kode_rows + $dump_kode;
			echo my_form_dropdown('kode', $kode_rows, '', '', '', 'class="form-control kodebahan"'); 
			echo "</div>";
		echo "</div>";

		$nama_rows = array();

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('Nama Bahan:', '', $label_attr);
			echo "<div class='col-sm-8'>";
			echo form_dropdown('nama', $nama_rows, '', 'class="form-control namabahan"');
			echo "</div>";
		echo "</div>";


		$manu_rows = array();
		$supp_rows = array();
		$jenis_rows = array(
			'Normal' => 'Normal',
			'Urgent' => 'Urgent',
			'Very Urgent' => 'Very Urgent',
		);
		
	
		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('Nama Supplier:', '', $label_attr);
			echo "<div class='col-sm-8'>";
			echo form_dropdown('supp', $supp_rows, '', 'class="form-control supplier"'); 
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('Nama Manufacturer:', '', $label_attr);
			echo "<div class='col-sm-8'>";
			echo form_dropdown('manu', $manu_rows, '', 'class="form-control manufaktur"');
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('Jenis Permintaan:', '', $label_attr);
			echo "<div class='col-sm-8'>";
			echo form_dropdown('jenis', $jenis_rows, $lpb[0]['Jenis_Permintaan'], 'class="form-control" required');
			echo "</div>";
		echo "</div>";
	?>
		
	<div class="button-container p-3">
		<button type="button submit" class="btn btn-primary" id="tambah">Simpan</button>
		<button onclick="window.history.back()" type="button" class="btn btn-danger" id="back">Kembali</button>
	</div>
	<?php
		echo form_close();
	?>
	<script type="text/javascript">
		var kodebahanval = "<?php echo $lpb[0]['Kode_Bahan']?>"
	</script>
</body>