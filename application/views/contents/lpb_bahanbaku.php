<?php
	$template = array(
        'table_open' => '<table class="table table-bordered table-hover decorated" cell-spacing="0">'
	);
	$this->table->set_template($template);
	$this->table->set_heading('No LPB', 'Tanggal Terima', 'Kode Bahan', 'Nomor Batch', 'Nama Supplier', 'Nama Manufacturer', 'Jumlah', 'Satuan', 'Status');

	foreach ($lpb as $row) {
		foreach ($lpb_batch as $rowb) {
			$a = $row->Nomor_LPB;
			$b = $rowb->Nomor_LPB;
			if ($b == $a) {
				$nolpb = array('data' => $row->Nomor_LPB, 'id' => $a);
				$tgl = array('data' => $row->Tanggal_Terima, 'id' => $a);
				$kode = array('data' => $row->Kode_Bahan, 'id' => $a);
				$btc = array('data' => $rowb->Nomor_Batch, 'id' => $a);
				$sup = array('data' => $row->Nama_Supplier, 'id' => $a);
				$mnf = array('data' => $row->Nama_Manufacturer, 'id' => $a);
				$jml = array('data' => $rowb->Jumlah, 'id' => $a);
				$sat = array('data' => $row->Satuan, 'id' => $a);
				$sta = array('data' => $rowb->Status, 'id' => $a);
				$this->table->add_row($nolpb, $tgl, $kode, $btc, $sup, $mnf, $jml, $sat, $sta);	
			}
		}
	}
	echo $this->table->generate();
	$this->table->clear();
?>
<div class="row button-container mr-0">
	<div class="col">
		<button onclick="location.href='<?php echo base_url();?>Gudang/tambah_lpb_show'" type="button" class="btn btn-block"><i class="fas fa-plus fa-fw fa-lg"></i> Tambah LPB</button>
	</div>
	<div class="col">
		<button id="print-bahanbaku" type="button" class="btn btn-block"><i class="fas fa-print fa-fw fa-lg"></i> Print All</button>
	</div>
</div>
