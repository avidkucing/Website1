<?php
	$template = array(
        'table_open' => '<table class="table table-bordered table-hover decorated" cell-spacing="0">'
	);
	$this->table->set_template($template);
	$this->table->set_heading('Username', 'Nama', 'Sebagai');

	foreach ($akun as $a) {
		$username = array('data' => $a->Username, 'data-id' => $a->Username);
		$nama = array('data' => $a->Nama, 'data-id' => $a->Username);
		$tipe = array('data' => $a->Tipe_Pegawai, 'data-id' => $a->Username);
		$this->table->add_row($username, $nama, $tipe);	
	}

	echo $this->table->generate();
	$this->table->clear();
?>

<!--<div class="row button-container mlr-0">
	<div class="col">
		<button class="btn btn-block" onclick="location.href='<?php echo base_url();?>Admin/user_registration_show'"; >Buat Akun Baru</button>
	</div>
</div>-->