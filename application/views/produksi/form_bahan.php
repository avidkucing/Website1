<!doctype html>

<head>
  <title>Permintaan Bahan Baku</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/print_lpb.css">
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/produksi.js"></script>
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
		echo form_open('produksi/new_permintaan_bahan', $form_attr);
	
		echo "<div class='content-item'>";
			echo "<div class='form-group'>";
			$label_attr = array('class' => 'control-label col-sm-4 text-left');
			echo form_label('Site Produksi:', ' ', $label_attr);
				echo "<div class='col-sm-8'>";
				$input_attr = array('class' => 'form-control');
				echo form_input('site', ' ', $input_attr);
				echo "</div>";
			echo "</div>";

			echo "<div class='form-group'>";
			$label_attr = array('class' => 'control-label col-sm-4 text-left');
			echo form_label('Nomor Instruksi:', ' ', $label_attr);
				echo "<div class='col-sm-8'>";
				$input_attr = array('class' => 'form-control');
				echo form_input('no_ins', ' ', $input_attr);
				echo "</div>";
			echo "</div>";

			echo "<div class='form-group'>";
			$label_attr = array('class' => 'control-label col-sm-4 text-left');
			echo form_label('Tanggal:', ' ', $label_attr);
				echo "<div class='col-sm-8'>";
				$date = array(
			        'type'          => 'date',
			        'name'          => 'tgl',
				);
				$input_attr = array('class' => 'form-control');
				echo form_input($date, ' ', $input_attr);
				echo "</div>";
			echo "</div>";

		echo "</div>";

		echo "<div class='content-item'>";
		
		?>
		
		<div class="button-container">
		<!--	<button type="button" class="btn" id="tambah" onClick="addRow('dataTable')">Tambah Bahan Baku</button>-->
	 		<button type="button" class="btn" id="back" onClick="deleteRow('dataTable')">Hapus Kolom</button>
	 	</div>
		
		<?php
		$template_bahan = array(
	        'table_open'            => '<table id="dataTable" class="content-item table table-bordered table-responsive">'
		);
		$this->table->set_template($template_bahan);
		$this->table->set_heading('Pilih', 'Kode Bahan', 'Nomor Analisa', 'Jumlah', 'Satuan', 'EXP Date', 'Keterangan');

		$kode_rows = $this->produksi_database->get_kode_bahan();
		$ana_rows = array();
		$jum_rows1 = array(
			'name' => 'jumlah[]',
			'class' => 'form-control jumlah1',
			'type' => 'number'
		);

		$jum_rows2 = array(
			'name' => 'jumlah[]',
			'class' => 'form-control jumlah2',
			'type' => 'number'
		);

		$jum_rows3 = array(
			'name' => 'jumlah[]',
			'class' => 'form-control jumlah3',
			'type' => 'number'
		);

		$jum_rows4 = array(
			'name' => 'jumlah[]',
			'class' => 'form-control jumlah4',
			'type' => 'number'
		);

		$jum_rows5 = array(
			'name' => 'jumlah[]',
			'class' => 'form-control jumlah5',
			'type' => 'number'
		);
		$sat_rows = array();
		$exp_rows = array();

		$bahan = array(
            array(form_checkbox('chk[]', 'accept', TRUE), my_form_dropdown('kode[]', $kode_rows, '', '', '',  'class="form-control kode1"'), form_dropdown('no_ana[]', $ana_rows, '', 'class="form-control no_ana1"'),  form_input($jum_rows1), form_dropdown('satuan[]', $sat_rows, '', 'class="form-control satuan1"'), form_dropdown('exp[]', $exp_rows, '', 'class="form-control exp1"'), form_input('keterangan[]', '-', 'class="form-control"')),
            array(form_checkbox('chk[]', 'accept', TRUE), my_form_dropdown('kode[]', $kode_rows, '', '', '',  'class="form-control kode2"'), form_dropdown('no_ana[]', $ana_rows, '', 'class="form-control no_ana2"'),  form_input($jum_rows2), form_dropdown('satuan[]', $sat_rows, '', 'class="form-control satuan2"'), form_dropdown('exp[]', $exp_rows, '', 'class="form-control exp2"'), form_input('keterangan[]', '-', 'class="form-control"')),
            array(form_checkbox('chk[]', 'accept', TRUE), my_form_dropdown('kode[]', $kode_rows, '', '', '',  'class="form-control kode3"'), form_dropdown('no_ana[]', $ana_rows, '', 'class="form-control no_ana3"'),  form_input($jum_rows3), form_dropdown('satuan[]', $sat_rows, '', 'class="form-control satuan3"'), form_dropdown('exp[]', $exp_rows, '', 'class="form-control exp3"'), form_input('keterangan[]', '-', 'class="form-control"')),
            array(form_checkbox('chk[]', 'accept', TRUE), my_form_dropdown('kode[]', $kode_rows, '', '', '',  'class="form-control kode4"'), form_dropdown('no_ana[]', $ana_rows, '', 'class="form-control no_ana4"'),  form_input($jum_rows4), form_dropdown('satuan[]', $sat_rows, '', 'class="form-control satuan4"'), form_dropdown('exp[]', $exp_rows, '', 'class="form-control exp4"'), form_input('keterangan[]', '-', 'class="form-control"')),
            array(form_checkbox('chk[]', 'accept', TRUE), my_form_dropdown('kode[]', $kode_rows, '', '', '',  'class="form-control kode5"'), form_dropdown('no_ana[]', $ana_rows, '', 'class="form-control no_ana5"'),  form_input($jum_rows5), form_dropdown('satuan[]', $sat_rows, '', 'class="form-control satuan5"'), form_dropdown('exp[]', $exp_rows, '', 'class="form-control exp5"'), form_input('keterangan[]', '-', 'class="form-control"'))
        );

		echo $this->table->generate($bahan);
		$this->table->clear();
		echo "</div>";

		echo "<br>";
		
		echo "</div>";
	?>

	<!--<p class="right-item sign">Signed By (Electronic Sign)</p>-->
	<div class="button-container">
		<button type="button submit" class="btn" id="tambah">Tambah</button>
		<button onclick="location.href='<?php echo base_url();?>produksi'" type="button" class="btn" id="back">Kembali</button>
		<!--<form class="button-item" action="gudang.html"><button type="button submit" class="btn" id="print">Print</button></form>-->
	</div>
	<?php
		echo form_close();
	?>
</body>