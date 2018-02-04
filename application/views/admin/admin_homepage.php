<!doctype html>

	<?php
		if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['username']);
			$email = ($this->session->userdata['logged_in']['email']);
			$nama = ($this->session->userdata['logged_in']['nama']);
		} else {
			header("location: login");
		}
	?>

<head>
	<title>Admin</title>
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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/admin.css">
	<script src="<?php echo base_url(); ?>public/js/admin.js"></script>
	<!--Data Tables-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dataTables.min.css">
    <script src="<?php echo base_url(); ?>public/js/dataTables.min.js"></script>
</head>
<body>
	<div id="for-web">
		<div class="row">
			<div class="col-md-2 sidebar">
				<div class="sidebar-header">
					<h2>Admin</h2>
					<p>Halo, <?php echo $nama;?></p>
				</div>
				<hr>
				<ul class="links list-unstyled">
					<li class="active" id="bahan"><a href="#">Data Bahan</a></li>
					<li id="surat"><a href="#">Data Surat</a></li>
					<li id="akun"><a href="#">Kelola Akun</a></li>
					<!--<li>
						<a id="other" href="#sublinks" data-toggle="collapse" aria-expanded="false">Lihat Lainnya<i class="fas fa-angle-down fa-fw fa-lg arrow"></i></a>
						<ul class="collapse list-unstyled" id="sublinks">
							<li><a href="#">Page</a></li>
							<li><a href="#">Page</a></li>
							<li><a href="#">Page</a></li>
						</ul>
					</li>-->
				</ul>
				<div class="links2 col-md-12">
					<ul class="list-unstyled">
						<li><a href="#"><i class="fas fa-bell fa-fw fa-lg"></i> Notifikasi</a></li>
						<li><a href="<?php echo base_url(); ?>Admin/logout"><i class="fas fa-power-off fa-fw fa-lg"></i> Logout</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-10 offset-md-2 content">
				<?php
					echo "<div class='error_msg'>";
					if (isset($message_display)) {
						echo $message_display;
					}
					echo "</div>";
				?>
				<div id="bahan-content">
					<div class="row button-container mr-0">
						<div class="col">
							<button class="btn btn-block" onclick="location.href='<?php echo base_url();?>Admin/add_data_bahan_baku_show'"; >Tambah Data Bahan Baku</button>
						</div>
						<div class="col">
							<button class="btn btn-block" onclick="location.href='<?php echo base_url();?>Admin/add_data_bahan_kemas_show'"; >Tambah Data Bahan Kemas</button>
						</div>
					</div>
				</div>
				<div id="surat-content" style="display: none;">
					<div class="row button-container mr-0">

					</div>
				</div>
				<div id="akun-content" style="display: none;">
					<div class="row button-container mr-0">
						<div class="col">
							<button class="btn btn-block" onclick="location.href='<?php echo base_url();?>Admin/user_registration_show'"; >Buat Akun Baru</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>