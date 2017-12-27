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
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/gudang.js"></script>
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
				<li id="bahanjaditab"><a href="#">Stock Bahan Jadi</a></li>
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
				<li><a href="gudang/logout"><i class="fas fa-power-off fa-fw fa-lg"></i> Logout</a></li>
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
			<table class="content-item table table-bordered table-hover table-responsive bahanbaku">
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
			<table class="content-item table table-bordered table-hover table-responsive bahanjadi" style="display: none;">
				<thead>
			        <tr>
				        <th>No.</th>
				        <th>Tanggal Release</th>
				        <th>No. Analisa</th>
				        <th>Kode Produk</th>
				        <th>Jumlah</th>
				    </tr>
				</thead>
				<tbody>
				    <tr>
				        <td>Test</td>
				        <td>Test</td>
				        <td>Test</td>
				        <td>Test</td>
				        <td>Test</td>
				    </tr>
				</tbody>
			</table>
			<button onclick="location.href='<?php echo base_url();?>Gudang/print_lpb_show'" type="button submit" class="content-item btn btn-block bahanjadi" style="display: none;"><i class="fas fa-plus fa-fw fa-lg"></i> Terbitkan Surat Jalan</button>
			<button onclick="location.href='<?php echo base_url();?>Gudang/tambah_lpb_show'" type="button submit" class="content-item btn btn-block bahanbaku"><i class="fas fa-plus fa-fw fa-lg"></i> Tambah LPB</button>
		</div>
	</div>
</body>