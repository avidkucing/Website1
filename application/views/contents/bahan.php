<?php
	$template = array(
        'table_open' => '<table class="table table-bordered table-hover decorated" cell-spacing="0">'
	);
	$this->table->set_template($template);
	$this->table->set_heading('Kode Bahan', 'Nama Bahan', 'Satuan', 'Jenis');

	foreach ($bahan as $row) {
		$a = $row->ID_Bahan;
		$kode = array('data' => $row->Kode_Bahan, 'id' => $a);
		$nama = array('data' => $row->Nama_Bahan, 'id' => $a);
		$sat = array('data' => $row->Satuan, 'id' => $a);
		$jen = array('data' => $row->Jenis, 'id' => $a);
		$this->table->add_row($kode, $nama, $sat, $jen);	
	}
	echo $this->table->generate();
	$this->table->clear();
?>
