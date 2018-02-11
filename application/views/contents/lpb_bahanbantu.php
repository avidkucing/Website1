<?php
	$template = array(
	    'table_open' => '<table class="table table-bordered table-hover decorated" cell-spacing="0" id="lpb_bahanbantu">'
	);
	$this->table->set_template($template);
	$this->table->set_heading('No LPB', 'Tanggal Terima', 'Kode Bahan', 'Nomor Batch', 'Nama Supplier', 'Nama Manufacturer', 'Jumlah', 'Satuan', 'Status');

	foreach ($lpb_bantu as $row) {
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
<script type="text/javascript">
	$('#lpb_bahanbantu tr td').click(function(){
        $link = window.location.origin + "/manufaktur/pages/print_lpb/" + (this.id);
        window.location.href=$link ;
    });
</script>