<?php
	$template = array(
        'table_open' => '<table class="table table-bordered table-hover decorated" cell-spacing="0">'
	);
	$this->table->set_template($template);
	$this->table->set_heading(/*'No Analisa', */'Kode Bahan', 'Nama Manufacturer', 'EXP. Date', 'Jumlah', 'Keterangan');

	foreach ($stock_bantu as $row) {
		$a = $row->Nomor_LPB;
		//$noana = array('data' => $row->Nomor_Analisa, 'id' => $a);
		$kode = array('data' => $row->Kode_Bahan, 'id' => $a);
		$mnf = array('data' => $row->Nama_Manufacturer, 'id' => $a);
		$exp = array('data' => $row->EXP_Date, 'id' => $a);
		$jml = array('data' => $row->Jumlah, 'id' => $a);
		$ket = array('data' => $row->Keterangan, 'id' => $a);
		$this->table->add_row(/*$noana, */$kode, $mnf, $exp, $jml, $ket);	
	}
	echo $this->table->generate();
	$this->table->clear();
?>