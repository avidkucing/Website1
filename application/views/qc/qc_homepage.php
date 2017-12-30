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
  <title>Quality Control Branch</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/qc.css">
    <script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/qc.js"></script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar">
			<div class="sidebar-header">
				<h2>Quality Control</h2>
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
				<li><a href="<?php echo base_url(); ?>quality_control/logout"><i class="fas fa-power-off fa-fw fa-lg"></i> Logout</a></li>
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

			<?php
				$template = array(
			        'table_open'            => '<table class="content-item table table-bordered table-hover table-responsive bahanbaku">'
				);
				$this->table->set_template($template);
				$this->table->set_heading('No. LPB',  'Nomor Instruksi Sampling', 'Tanggal Terima', 'Kode Bahan', 'Nomor Batch', 'Jumlah Sampel', 'Satuan','Nomor Analisa', 'Sisa Sampel Pertinggal');
				
				//print_r($lps_analisa); baru bisa dilihat setelah fungsi tambahnya jadi
					
				foreach ($lps_sampel as $x) {
					$kode = $x->Nomor_Batch;
					$ins[$kode] = $x->Nomor_Instruksi;
					$jum[$kode] = $x->Jumlah_Sampel;
					$ana[$kode] = $x->Nomor_Analisa;
					$sisa[$kode] = $x->Sisa_Sampel;
				}

				foreach ($lps as $row) {
					foreach ($lps_batch as $rowb) {
						$a = $row->Nomor_LPB;
 						$b = $rowb->Nomor_LPB;
 						$c = $rowb->Nomor_Batch;
 						
 						$link_instruksi = anchor('quality_control/instruksi_sampling_bahan_show/'.$c ,'Isi');
						$link_analisa = anchor('quality_control/analisa_sampling_bahan_show/'.$c ,'Isi');
 						if ($b == $a) {
 							if (!(isset($ins[$c]))) {
<<<<<<< HEAD
 								$form_ins = array('data' => '--isi--','id' => $c, 'class' => 'instruksi');
 								$this->table->add_row($row->Nomor_LPB, $form_ins, $row->Tanggal_Terima, $row->Kode_Bahan, $rowb->Nomor_Batch, $form_ins, $row->Satuan, '', '');	
 							} else if (($ana[$c] == $ins[$c])) {
 								$form_ana = array('data' => '--isi--', 'id' => $c, 'class' => 'analisa');
 								$this->table->add_row($row->Nomor_LPB, $ins[$c], $row->Tanggal_Terima, $row->Kode_Bahan, $rowb->Nomor_Batch, $jum[$c], $row->Satuan, $form_ana, $form_ana);
=======
 								$this->table->add_row($row->Nomor_LPB, $link_instruksi, $row->Tanggal_Terima, $row->Kode_Bahan, $rowb->Nomor_Batch, $link_instruksi, $row->Satuan, 'analisa', 'sisa');	
 							} else if (($ana[$c] == $ins[$c])) {
 								$this->table->add_row($row->Nomor_LPB, $ins[$c], $row->Tanggal_Terima, $row->Kode_Bahan, $rowb->Nomor_Batch, $jum[$c], $row->Satuan, $link_analisa, $link_analisa);
>>>>>>> e968e80a12c6b4268372a7e8e04e829aab11001d
 							} else {
 								$this->table->add_row($row->Nomor_LPB, $ins[$c], $row->Tanggal_Terima, $row->Kode_Bahan, $rowb->Nomor_Batch, $ins[$c], $row->Satuan, $ana[$c], $sisa[$c]);
 							}
 							
 						}
					}
				}
				echo $this->table->generate();
			?>
		</div>
	</div>
</body>