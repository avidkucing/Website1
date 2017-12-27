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
    <script src="<?php echo base_url(); ?>public/js/gudang.js"></script>
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
				<li><a href="quality_control/logout"><i class="fas fa-power-off fa-fw fa-lg"></i> Logout</a></li>
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
				$this->table->set_heading('No. LPB',  'Nomor Instruksi Sampling', 'Tanggal Terima', 'Kode Bahan', 'Nomor Batch', 'Jumlah Sampel', 'Satuan','Nomor Analisa', 'Sisa Sampel Pertinggal');
				
				//print_r($lps_analisa); baru bisa dilihat setelah fungsi tambahnya jadi
				
				
				foreach ($lps as $row) {
					
					//indeks nomor batch & form
					$a = $row->Nomor_LPB;
					
					//link untuk isi form
					$link_instruksi = anchor('quality_control/instruksi_sampling_bahan_show/'.$a ,'Isi');
					$link_analisa = anchor('quality_control/analisa_sampling_bahan_show/'.$a ,'Isi');

					////////////////////////////////////////////////////////
					//convert $lps_instruksi
					$b = 0;
					$lps_ins = array();

					foreach ($lps_instruksi as $x => $b) {
						$kode = $lps_instruksi[$x]['Nomor_LPB'];
						$lps_ins[$kode] = $lps_instruksi[$x]['Nomor_Instruksi'];
						$lps_ins_j[$kode] = $lps_instruksi[$x]['Jumlah_Sampel'];
					}
					//convert $lps_analisa
					$b = 0;
					$lps_ana = array();

					foreach ($lps_analisa as $y => $b) {
						$kode = $lps_analisa[$y]['Nomor_LPB'];
						$lps_ana[$kode] = $lps_analisa[$y]['Nomor_Analisa'];
						$lps_ana_s[$kode] = $lps_analisa[$y]['Sisa_Sampel'];
					}
					////////////////////////////////////////////////////////

					//cek form apa sudah diisi
					if (!(isset($lps_ins[$a]))) {
						$this->table->add_row($row->Nomor_LPB, $link_instruksi , $row->Tanggal_Terima, $row->Kode_Bahan, $lps_batch[$a], $link_instruksi, $row->Satuan, 'Isi instruksi terlebih dahulu', 'Isi instruksi terlebih dahulu');
					} else if (($lps_ana[$a]) == ($lps_ins[$a])) {
						$this->table->add_row($row->Nomor_LPB, $lps_ins[$a] , $row->Tanggal_Terima, $row->Kode_Bahan, $lps_batch[$a], $lps_ins_j[$a], $row->Satuan, $link_analisa, $link_analisa);
					} else {
						$this->table->add_row($row->Nomor_LPB, $lps_ins[$a] , $row->Tanggal_Terima, $row->Kode_Bahan, $lps_batch[$a], $lps_ins_j[$a], $row->Satuan, $lps_ana[$a], $lps_ana_s[$a]);
					}
					
				}
				echo $this->table->generate();
			?>
			<!--<table class="content-item table table-bordered table-hover table-responsive bahanbaku">
				<thead>
			        <tr>
				        <th>No.</th>
				        <th>No. LPB</th>
				        <th>Tanggal Terima</th>
				        <th>Kode Bahan</th>
				        <th>No. Batch</th>
				        <th>Nama Supplier</th>
				        <th>Nama Manufacturer</th>
				        <th>Jumlah</th>
				        <th>Satuan</th>
				        <th>Status</th>
				    </tr>
				</thead>
				<tbody>
				    <tr><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td></tr>
				    <tr><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td></tr>
				    <tr><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td></tr>
				    <tr><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td></tr>
				    <tr><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td></tr>
				    <tr><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td></tr>
				    <tr><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td><td>Test</td></tr>
				</tbody>
			</table>
			-->
		</div>
	</div>
</body>