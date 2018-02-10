<?php
	$template = array(
        'table_open' => '<table class="table table-bordered table-hover decorated" cell-spacing="0" id="lpb_bahanbaku">'
	);
	$this->table->set_template($template);
	$this->table->set_heading('No LPB', 'Tanggal Terima', 'Kode Bahan', 'Nomor Batch', 'Nama Supplier', 'Nama Manufacturer', 'Jumlah', 'Satuan', 'Status');

	foreach ($lpb as $row) {
		foreach ($lpb_batch as $rowb) {
			$a = $row->Nomor_LPB;
			$b = $rowb->Nomor_LPB;
			if ($b == $a) {
				$nolpb = array('data' => $row->Nomor_LPB, 'id' => $a, 'class' => 'lpb_row');
				$tgl = array('data' => $row->Tanggal_Terima, 'id' => $a, 'class' => 'lpb_row');
				$kode = array('data' => $row->Kode_Bahan, 'id' => $a, 'class' => 'lpb_row');
				$btc = array('data' => $rowb->Nomor_Batch, 'id' => $a, 'class' => 'lpb_row');
				$sup = array('data' => $row->Nama_Supplier, 'id' => $a, 'class' => 'lpb_row');
				$mnf = array('data' => $row->Nama_Manufacturer, 'id' => $a, 'class' => 'lpb_row');
				$jml = array('data' => $rowb->Jumlah, 'id' => $a, 'class' => 'lpb_row');
				$sat = array('data' => $row->Satuan, 'id' => $a, 'class' => 'lpb_row');
				$sta = array('data' => $rowb->Status, 'id' => $a, 'class' => 'lpb_row');
				$this->table->add_row($nolpb, $tgl, $kode, $btc, $sup, $mnf, $jml, $sat, $sta);	
			}
		}
	}
	echo $this->table->generate();
	$this->table->clear();
?>
<script type="text/javascript">
	$('.lpb_row').click(function(){
        $link = window.location.origin + "/manufaktur/pages/print_lpb/" + (this.id);
        window.location.href=$link ;
    });
</script>
