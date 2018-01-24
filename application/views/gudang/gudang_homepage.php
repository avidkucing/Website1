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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- jQuery library -->
	<script src="<?php echo base_url(); ?>public/js/jquery-3.2.1.min.js"></script>
	<!--Bootstrap 4-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
	<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
	<!--Icons-->
	<script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
	<!--Our Custom CSS & JS-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/global.css">
	<script src="<?php echo base_url(); ?>public/js/global.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/gudang.css">
	<script src="<?php echo base_url(); ?>public/js/gudang.js"></script>
	<!--Data Tables-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dataTables.min.css">
    <script src="<?php echo base_url(); ?>public/js/dataTables.min.js"></script>
</head>

<body>
	<div id="for-web">
		<div class="row">
			<div class="col-md-2 sidebar">
				<div class="sidebar-header">
					<h2>Warehouse</h2>
					<p>Halo, <?php echo $nama;?></p>
				</div>
				<hr>
				<ul class="links list-unstyled">
					<li class="active" id="bahanbakutab"><a href="#">Stock Bahan Baku</a></li>
					<li id="bahankemastab"><a href="#">Stock Bahan Kemas</a></li>
					<li id="bahanjaditab"><a href="#">Permintaan Bahan Baku</a></li>
					<li>
						<a id="other" href="#sublinks" data-toggle="collapse" aria-expanded="false">Lihat Lainnya<i class="fas fa-angle-down fa-fw fa-lg arrow"></i></a>
						<ul class="collapse list-unstyled" id="sublinks">
							<li><a href="#">Page</a></li>
							<li><a href="#">Page</a></li>
							<li><a href="#">Page</a></li>
						</ul>
					</li>
				</ul>
				<div class="links2 col-md-12">
					<ul class="list-unstyled">
						<li><a href="#"><i class="fas fa-bell fa-fw fa-lg"></i> Notifikasi</a></li>
						<li><a href="<?php echo base_url(); ?>gudang/logout"><i class="fas fa-power-off fa-fw fa-lg"></i> Logout</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-10 offset-md-2 content">
				<?php
				if (isset($message_display)) {
					echo "<div class='message'>";
					echo $message_display;
					echo "</div>";
				}
				?>
				<div id="bahanbaku">
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
			 		<div class="row button-container">
						<div class="col-md-6">
			 				<button onclick="location.href='<?php echo base_url();?>Gudang/tambah_lpb_show'" type="button" class="btn btn-block"><i class="fas fa-plus fa-fw fa-lg"></i> Tambah LPB</button>
			 			</div>
			 			<div class="col-md-6">
			 				<button id="print-all" type="button" class="btn btn-block"><i class="fas fa-print fa-fw fa-lg"></i> Print All</button>
			 			</div>
					</div>
				</div>

				<div id="bahankemas" style="display: none";>
					<?php
	 				$template = array(
	 			        'table_open' => '<table class="table table-bordered table-hover decorated" cell-spacing="0">'
	 				);
	 				$this->table->set_template($template);
	 				$this->table->set_heading('No LPB', 'Tanggal Terima', 'Kode Bahan', 'Nomor Batch', 'Nama Supplier', 'Nama Manufacturer', 'Jumlah', 'Satuan', 'Status');

	 				foreach ($lpb_kemas as $row) {
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
			 		<div class="row button-container">
						<div class="col-md-6">
			 				<button onclick="location.href='<?php echo base_url();?>Gudang/tambah_lpb_show'" type="button" class="btn btn-block"><i class="fas fa-plus fa-fw fa-lg"></i> Tambah LPB</button>
			 			</div>
			 			<div class="col-md-6">
			 				<button id="print-all" type="button" class="btn btn-block"><i class="fas fa-print fa-fw fa-lg"></i> Print All</button>
			 			</div>
					</div>
				</div>
				
				<div id="bahanjadi" style="display: none;">
					<?php
		 				$template = array(
		 			        'table_open' => '<table class="table table-bordered table-hover decorated" cell-spacing="0">'
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
			</div>
		</div>
	</div>
	<div id="for-print" style="display: none;">
		<h1>PT. Hisamitsu</h1>
	</div>
</body>