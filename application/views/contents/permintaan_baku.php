<?php
	$template = array(
        'table_open' => '<table class="table table-bordered table-hover decorated" cell-spacing="0">'
	);
	$this->table->set_template($template);
	$this->table->set_heading('No Instruksi', 'Site Produksi', 'Tanggal Permintaan');
	
	foreach ($permintaan_baku as $row) {
		$a = $row->Nomor_Instruksi;
	$no_ins = array('data' => $row->Nomor_Instruksi, 'id' => $a);
	$site = array('data' => $row->Site_Produksi, 'id' => $a);
	$tgl = array('data' => $row->Tanggal_Permintaan, 'id' => $a);
	$this->table->add_row($no_ins, $site, $tgl);
	}

	echo $this->table->generate();
	$this->table->clear();
?>