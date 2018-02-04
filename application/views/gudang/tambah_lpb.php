<!doctype html>

<head>
	<title>Tambah LPB</title>
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

	<h1 class="text-center p-3">Tambah LPB</h1>

	<?php	
		$form_attr = array('class' => 'form-horizontal');
		echo form_open('gudang/new_lpb', $form_attr);
	
		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('No. LPB:', ' ', $label_attr);
			echo "<div class='col-sm-8'>";
			$input_attr = array('class' => 'form-control nolpb', 'pattern' => '[0-9]+/[a-zA-z]+/[a-zA-z]+/[0-9]{4}', 'required' => '');
			echo form_input('lpb', '', $input_attr);
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('Tgl Terima:', ' ', $label_attr);
			echo "<div class='col-sm-8'>";
			$date = array(
		        'type'          => 'date',
		        'name'          => 'tgl',
			);
			$input_attr = array('class' => 'form-control tglterima', 'required' => '');
			echo form_input($date, ' ', $input_attr);
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('No. Surat Pesanan:', ' ', $label_attr);
			echo "<div class='col-sm-8'>";
			$input_attr = array('class' => 'form-control', 'pattern' => '[0-9]+/[P]+[S]+/[a-zA-z]+/[0-9]{4}', 'required' => '');
			echo form_input('surat', ' ', $input_attr);
			echo "</div>";
		echo "</div>";

		//opsi bahan baku/bahan kemas
		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'control-label col-sm-2 offset-sm-1');
		echo form_label('Jenis Bahan:', ' ', $label_attr);
			echo "<div class='col-sm-8'>";
			$jenis_bahan = array ('' => '--Pilih Opsi Jenis Bahan--', 'Baku' => 'Bahan Baku', 'Kemas' => 'Bahan Kemas', 'Pembantu' => 'Bahan Pembantu');
			echo my_form_dropdown('jenis', $jenis_bahan,'', '', '', 'class="form-control jenisbahan"'); 
			echo "</div>";
		echo "</div>";

		//get object return from gudang database model & initial array kosong untuk form
		//$kode_rows = $this->gudang_database->get_kode_bahan();
		$kode_rows = array();
		
		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'control-label col-sm-2 offset-sm-1');
		echo form_label('Kode Bahan:', ' ', $label_attr);
			echo "<div class='col-sm-8'>";
			$dump_kode = array ('' => '--Pilih Opsi Bahan--');
			$kode_rows = $kode_rows + $dump_kode;
			echo my_form_dropdown('kode', $kode_rows,'', '', '', 'class="form-control kodebahan"'); 
			echo "</div>";
		echo "</div>";
		/*
		//get object return from gudang database model & initial array kosong untuk form
		$kode_rows = $this->gudang_database->get_kode_bahan();
		$nama_rows = array();

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('Kode Bahan:', ' ', $label_attr);
			echo "<div class='col-sm-8'>";
			$dump_kode = array ('' => '--Pilih Opsi Bahan Baku--');
			$kode_rows = $kode_rows + $dump_kode;
			echo my_form_dropdown('kode', $kode_rows,'', '', '', 'class="form-control kodebahan"'); 
			echo "</div>";
		echo "</div>";
	*/
		$nama_rows = array();

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('Nama Bahan:', ' ', $label_attr);
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
		echo form_label('Nama Supplier:', ' ', $label_attr);
			echo "<div class='col-sm-8'>";
			echo form_dropdown('supp', $supp_rows, '', 'class="form-control supplier"'); 
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('Nama Manufacturer:', ' ', $label_attr);
			echo "<div class='col-sm-8'>";
			echo form_dropdown('manu', $manu_rows, '', 'class="form-control manufaktur"');
			echo "</div>";
		echo "</div>";

		echo "<div class='form-group row'>";
		$label_attr = array('class' => 'col-form-label col-sm-2 offset-sm-1');
		echo form_label('Jenis Permintaan:', ' ', $label_attr);
			echo "<div class='col-sm-8'>";
			echo form_dropdown('jenis', $jenis_rows, '', 'class="form-control" required');
			echo "</div>";
		echo "</div>";
		?>
		
		<div class="button-container p-3">
			<button type="button" class="btn" id="tambah" onClick="addRow('dataTable')">Tambah Nomor Batch</button>
	 		<button type="button" class="btn" id="back" onClick="deleteRow('dataTable')">Hapus Nomor Batch</button>
	 	</div>

	 	<div class="form-group row">
	 		<div class="col-md-10 offset-md-1">
	 			<?php
					$template_batch = array(
				        'table_open' => '<table id="dataTable" class="table table-bordered" cell-spacing="0">'
					);
					$this->table->set_template($template_batch);
					$this->table->set_heading('Pilih', 'Nomor Batch', 'Jumlah', 'Satuan', 'Keterangan', 'EXP. Date');
					$exp_date = array(
			        	'type'          => 'date',
			        	'name'          => 'exp[]',
					);
					$ket = array(
						'name' => 'keterangan[]',
						'rows' => '1',
					);
					$batch = array(
			            array(form_checkbox('chk[]', 'accept', TRUE), form_input('batch[]', '', 'class="form-control" required'), form_input('jumlah[]', '', 'class="form-control" required'),  form_dropdown('satuan', $manu_rows, '', 'class="form-control satuan"'), form_textarea($ket, '', 'class="form-control"'), form_input($exp_date, '', 'class="form-control" required'))
			        );

					echo $this->table->generate($batch);
					$this->table->clear();
				?>
	 		</div>
	 		
	 	</div>
		
	<div class="button-container p-3">
		<button type="button submit" class="btn" id="tambah">Tambah</button>
		<button onclick="location.href='<?php echo base_url();?>gudang'" type="button" class="btn" id="back">Kembali</button>
	</div>
	<?php
		echo form_close();
	?>
</body>