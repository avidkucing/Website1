<!doctype html>

	<?php
		if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
			$email = ($this->session->userdata['logged_in']['email']);
			$nama = ($this->session->userdata['logged_in']['nama']);
			$tipe = ($this->session->userdata['logged_in']['tipe']);
		} else {
			header("location: login");
		}
	?>

<head>
 	<title>Gudang</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/gudang.css">
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/gudang.js"></script>
    <!--Data Tables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar">
			<div class="sidebar-header">
				<h2>Warehouse</h2>
				<h4>Halo, <?php echo $nama;?></h4>
			</div>
			<ul class="links list-unstyled">
				<li class="active" id="bahanbakutab"><a href="#">Stock Bahan Baku</a></li>
				<li id="bahanjaditab"><a href="#">List Permintaan Bahan Baku</a></li>
				<li>
					<a href="#sublinks" data-toggle="collapse" aria-expanded="false">Lihat Lainnya</a>
					<ul class="collapse list-unstyled" id="sublinks">
						<li><a href="#">Page</a></li>
						<li><a href="#">Page</a></li>
						<li><a href="#">Page</a></li>
						<li><a href="#">Page</a></li>
						<li><a href="#">Page</a></li>
					</ul>
				</li>
			</ul>
			<ul class="links2 list-unstyled">
				<li><a href="#"><i class="fas fa-bell fa-fw fa-lg"></i> Notifikasi</a></li>
				<li><a href="<?php echo base_url(); ?>gudang/logout"><i class="fas fa-power-off fa-fw fa-lg"></i> Logout</a></li>
			</ul>
		</nav>
		<div id="content">
			<div class="content-table">
				<?php
				if (isset($message_display)) {
					echo "<div class='message'>";
					echo $message_display;
					echo "</div>";
				}
				?>
	 			<?php
	 				$template = array(
	 			        'table_open'            => '<table id="tabel" class="table table-bordered table-hover table-responsive bahanbaku">'
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
	 			<?php
	 				$template = array(
	 			        'table_open'            => '<table id="tabel2" class="table table-bordered table-hover table-responsive bahanbaku" style="display: none;">'
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
	 			<?php
	 				$template = array(
	 			        'table_open'            => '<table id="tabel3" class="table table-bordered table-hover table-responsive bahanjadi" style="display: none;">'
	 				);
	 				$this->table->set_template($template);
	 				$this->table->set_heading('No Instruksi', 'Site Produksi', 'Tanggal Permintaan');
	 				
	 				foreach ($ins as $row) {
	 					$a = $row->Nomor_Instruksi;
						$no_ins = array('data' => $row->Nomor_Instruksi, 'id' => $a);
						$site = array('data' => $row->Site_Produksi, 'id' => $a);
						$tgl = array('data' => $row->Tanggal_Permintaan, 'id' => $a);
						$this->table->add_row($no_ins, $site, $tgl);
	 				}

	 				echo $this->table->generate();
	 				$this->table->clear();
	 			?>
 			</div>
 			<div class="button-container row">
 				<div class="col-sm-6">
 					<button onclick="location.href='<?php echo base_url();?>Gudang/tambah_lpb_show'" type="button submit" class="btn btn-block bahanbaku"><i class="fas fa-plus fa-fw fa-lg"></i> Tambah LPB</button>
 				</div>
 				<div class="col-sm-6">
 					<button id="print-all" class="btn btn-block" type="button">Print</button>
 				</div>
 			</div>
 			
			<button onclick="location.href='<?php echo base_url();?>Gudang/print_lpb_show'" type="button submit" class="btn btn-block bahanjadi" style="display: none;"><i class="fas fa-plus fa-fw fa-lg"></i> Terbitkan Surat Jalan</button>
		</div>
	</div>
</body>