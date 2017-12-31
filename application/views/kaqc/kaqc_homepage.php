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
  <title>Quality Control</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/gudang.css">
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/kaqc.js"></script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar">
			<div class="sidebar-header">
				<h2>Head of Quality Control</h2>
				<h4>Halo, <?php echo $nama;?></h4>
			</div>
			<ul class="links list-unstyled">
				<li class="active" id="bahanbakutab"><a href="#">List Penerimaan Sampel</a></li>
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
				<li><a href="<?php echo base_url(); ?>ka_quality_control/logout"><i class="fas fa-power-off fa-fw fa-lg"></i> Logout</a></li>
			</ul>
		</nav>
		<div id="content">
			<?php
			if (isset($message_display)) {
				echo "<div class='message'>";
				echo $message_display;
				echo "</div>";
			}
			?>
			<input type="text" class="content-item form-control" placeholder="Search" style="display: none;">

			<?php
				$template = array(
			        'table_open'            => '<table class="content-item table table-bordered table-hover table-responsive bahanbaku">'
				);
				$this->table->set_template($template);
				$this->table->set_heading('No. LPB',  'Nomor Instruksi Sampling', 'Tanggal Terima', 'Kode Bahan', 'Nomor Batch', 'Jumlah Sampel', 'Satuan','Nomor Analisa', 'Sisa Sampel Pertinggal', 'Status');
				
				foreach ($lps_sampel as $x) {
					$kode = $x->Nomor_Batch;
					$ins[$kode] = $x->Nomor_Instruksi;
					$jum[$kode] = $x->Jumlah_Sampel;
				}
				foreach ($lps_analisa as $x) {
					$kode = $x->Nomor_Batch;
					$ana[$kode] = $x->Nomor_Analisa;
					$sisa[$kode] = $x->Sisa_Sampel;
				}
				foreach ($lps as $row) {
					foreach ($lps_batch as $rowb) {
						$a = $row->Nomor_LPB;
 						$b = $rowb->Nomor_LPB;
 						$c = $rowb->Nomor_Batch;
 						$cek_status = $rowb->Status;
 						
 						if ($b == $a) {
 							if (!(isset($ins[$c]))) {
								$this->table->add_row($row->Nomor_LPB, 'Belum Diinstruksikan' , $row->Tanggal_Terima, $row->Kode_Bahan, $c, 'Belum Diinstruksikan', $row->Satuan, 'Belum Dianalisa', 'Belum Dianalisa', $rowb->Status);
							} else if (!(isset($ana[$c]))) {
								$this->table->add_row($row->Nomor_LPB, $ins[$c] , $row->Tanggal_Terima, $row->Kode_Bahan, $c, $jum[$c], $row->Satuan, 'Belum Dianalisa', 'Belum Dianalisa', $rowb->Status);
							} else if ($cek_status == 'QUARANTINE') {
								$form_status = array('data' => '--isi--', 'id' => $c, 'class' => 'status');
								$this->table->add_row($row->Nomor_LPB, $ins[$c] , $row->Tanggal_Terima, $row->Kode_Bahan, $c, $jum[$c], $row->Satuan, $ana[$c], $sisa[$c], $form_status);
							} else {
								$this->table->add_row($row->Nomor_LPB, $ins[$c] , $row->Tanggal_Terima, $row->Kode_Bahan, $c, $jum[$c], $row->Satuan, $ana[$c], $sisa[$c], $rowb->Status);
							}
 						}
					}
				}
				echo $this->table->generate();
			?>
		</div>
	</div>
</body>