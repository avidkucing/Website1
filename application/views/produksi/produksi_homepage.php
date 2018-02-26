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
 	<title>Produksi</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/produksi.css">
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/produksi.js"></script>
    <!--Data Tables-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar">
			<div class="sidebar-header">
				<h2>Production</h2>
				<h4>Halo, <?php echo $nama;?></h4>
			</div>
			<ul class="links list-unstyled">
				<li class="active" id="bahanbakutab"><a href="#">List Permintaan Bahan Baku</a></li>
				<!--<li id="bahanjaditab"><a href="#">Stock Bahan Jadi</a></li>-->
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
				<li><a href="<?php echo base_url(); ?>produksi/logout"><i class="fas fa-power-off fa-fw fa-lg"></i> Logout</a></li>
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
	 			        'table_open'            => '<table id="tabel" class="table table-bordered table-hover table-responsive permintaan">'
	 				);
	 				$this->table->set_template($template);
	 				$this->table->set_heading('No Instruksi', /*'Site Produksi', */'Tanggal Permintaan', 'Status');
	 				
	 				foreach ($ins as $row) {
	 					$a = $row->Nomor_Instruksi;
						$no_ins = array('data' => $row->Nomor_Instruksi, 'id' => $a);
						//$site = array('data' => $row->Site_Produksi, 'id' => $a);
						$tgl = array('data' => $row->Tanggal_Permintaan, 'id' => $a);
						$stat = array('data' => $row->Status, 'id' => $a);
						$this->table->add_row($no_ins, /*$site, */$tgl, $stat);
	 				}

	 				echo $this->table->generate();
	 				$this->table->clear();
	 			?>
 			</div>
 			<button onclick="location.href='<?php echo base_url();?>produksi/form_bahan_show'" type="button submit" class="content-item btn btn-block bahanbaku"><i class="fas fa-plus fa-fw fa-lg"></i> Minta Stok Bahan Baku</button>
			<!--<button onclick="location.href='<?php echo base_url();?>produksi/print_lpb_show'" type="button submit" class="content-item btn btn-block bahanjadi" style="display: none;"><i class="fas fa-plus fa-fw fa-lg"></i> Terbitkan Surat Jalan</button>-->
		</div>
	</div>
</body>