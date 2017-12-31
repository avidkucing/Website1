<!doctype html>

<head>
  <title>Tambah LPB</title>
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
		
		$form_attr = array('class' => 'form-horizontal');
		echo form_open('gudang/new_lpb', $form_attr);
	
		echo "<div class='content-item'>";
			echo "<div class='form-group'>";
			$label_attr = array('class' => 'control-label col-sm-4 text-left');
			echo form_label('No. LPB:', ' ', $label_attr);
				echo "<div class='col-sm-8'>";
				$input_attr = array('class' => 'form-control nolpb');
				echo form_input('lpb', ' ', $input_attr);
				echo "</div>";
			echo "</div>";

			echo "<div class='form-group'>";
			$label_attr = array('class' => 'control-label col-sm-4 text-left');
			echo form_label('Tgl Terima:', ' ', $label_attr);
				echo "<div class='col-sm-8'>";
				$date = array(
			        'type'          => 'date',
			        'name'          => 'tgl',
				);
				$input_attr = array('class' => 'form-control tglterima');
				echo form_input($date, ' ', $input_attr);
				echo "</div>";
			echo "</div>";

			echo "<div class='form-group'>";
			$label_attr = array('class' => 'control-label col-sm-4 text-left');
			echo form_label('No. Surat Pesanan:', ' ', $label_attr);
				echo "<div class='col-sm-8'>";
				$input_attr = array('class' => 'form-control');
				echo form_input('surat', ' ', $input_attr);
				echo "</div>";
			echo "</div>";
		echo "</div>";

		echo "<div class='content-item'>";
			//get object return from gudang database model & initial array kosong untuk form
			$kode_rows = $this->gudang_database->get_kode_bahan();
			$nama_rows = array();

			echo "<div class='form-group'>";
			$label_attr = array('class' => 'control-label col-sm-4 text-left');
			echo form_label('Kode Bahan:', ' ', $label_attr);
				echo "<div class='col-sm-8'>";
				$dump_kode = array ('' => '--Pilih Opsi Bahan Baku--');
				$kode_rows = $kode_rows + $dump_kode;
				echo my_form_dropdown('kode', $kode_rows,'', '', '', 'class="form-control kodebahan"'); 
				echo "</div>";
			echo "</div>";

			echo "<div class='form-group'>";
			$label_attr = array('class' => 'control-label col-sm-4 text-left');
			echo form_label('Nama Bahan:', ' ', $label_attr);
				echo "<div class='col-sm-8'>";
				echo form_dropdown('nama', $nama_rows, '', 'class="form-control namabahan"');
				echo "</div>";
			echo "</div>";
		echo "</div>";


		echo "<div class='content-item'>";
			$manu_rows = array();
			$supp_rows = array();
		
			echo "<div class='form-group'>";
			$label_attr = array('class' => 'control-label col-sm-4 text-left');
			echo form_label('Nama Supplier:', ' ', $label_attr);
				echo "<div class='col-sm-8'>";
				echo form_dropdown('supp', $supp_rows, '', 'class="form-control supplier"'); 
				echo "</div>";
			echo "</div>";

			echo "<div class='form-group'>";
			$label_attr = array('class' => 'control-label col-sm-4 text-left');
			echo form_label('Nama Manufacturer:', ' ', $label_attr);
				echo "<div class='col-sm-8'>";
				echo form_dropdown('manu', $manu_rows, '', 'class="form-control manufaktur"');
				echo "</div>";
			echo "</div>";
		echo "</div>";

		echo "<div class='content-item'>";
		
		//nomor batch
		?>

		<div class="button-container">
			<button type="button" class="btn" id="tambah" onClick="addRow('dataTable')">Tambah Nomor Batch</button>
	 		<button type="button" class="btn" id="back" onClick="deleteRow('dataTable')">Hapus Nomor Batch</button>
	 		<br><br>
	 	</div>

		<?php
		$template_batch = array(
	        'table_open'            => '<table id="dataTable" class="content-item table table-bordered table-responsive">'
		);
		$this->table->set_template($template_batch);
		$this->table->set_heading('Pilih', 'Nomor Batch', 'Jumlah', 'Satuan');
		$batch = array(
            array(form_checkbox('chk[]', 'accept', TRUE), form_input('batch[]', '', 'class="form-control"'), form_input('jumlah[]', '', 'class="form-control"'),  form_dropdown('satuan', $manu_rows, '', 'class="form-control satuan"'))
        );

		echo $this->table->generate($batch);
		$this->table->clear();
		echo "</div>";

		echo "<br>";
		
		echo "</div>";
	?>

	<!--<p class="right-item sign">Signed By (Electronic Sign)</p>-->
	<div class="button-container">
		<button type="button submit" class="btn" id="tambah">Tambah</button>
		<button onclick="location.href='<?php echo base_url();?>gudang'" type="button" class="btn" id="back">Kembali</button>
		<br>
		<br>
		<!--<form class="button-item" action="gudang.html"><button type="button submit" class="btn" id="print">Print</button></form>-->
	</div>
	<?php
		echo form_close();
	?>
</body>