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
	<script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
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
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/select.dataTables.min.css">
    <script src="<?php echo base_url(); ?>public/js/dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/dataTables.select.min.js"></script>
</head>
<body>
	<div class="modal fade" id="editor" tabindex="-1" role="dialog">
	 	<div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		    <form id="form-edit">
		      	<div class="modal-header">
			        <h5 class="modal-title">Edit Data</h5>
			        <button type="button" class="close" data-dismiss="modal">
			        	<span>&times;</span>
			        </button>
		      	</div>
		    	<div class="modal-body">
		        	<div class="form-group row">
		        		<label for="uname" class="col-md-2 col-form-label">Username:</label>
		        		<div class="col-md-10">
		        			<input type="text" class="form-control" id="uname" name="uname" disabled> <!--@TODO add validation-->
		        		</div>
		        	</div>
		        	<div class="form-group row">
		        		<label for="nama" class="col-md-2 col-form-label">Nama:</label>
						<div class="col-md-10">
		        			<input type="text" class="form-control" id="nama" name="nama">
		        		</div>
		        	</div>
		        	<div class="form-group row">
		        		<label for="tipe" class="col-md-2 col-form-label">Tipe:</label>
						<div class="col-md-10">
		        			<select class="custom-select" id="tipe">
							    <option value="Gudang">Gudang</option>
							    <option value="Kepala Bagian Gudang">Kepala Bagian Gudang</option>
							    <option value="Quality Control">Quality Control</option>
							    <option value="Kepala Bagian Quality Control">Kepala Bagian Quality Control</option>
							    <option value="Quality Assurance">Quality Assurance</option>
							    <option value="Kepala Bagian Quality Assurance">Kepala Bagian Quality Assurance</option>
							    <option value="Produksi">Produksi</option>
							    <option value="Kepala Bagian Produksi">Kepala Bagian Produksi</option>
							    <option value="Administrator">Administrator</option>
						 	</select>
		        		</div>
		        	</div>
		        	<div class="form-group row">
		        		<label for="password" class="col-md-2 col-form-label">Password:</label>
						<div id="passdiv" class="col-md-10" style="display: none;">
		        			<input type="text" class="form-control" id="password" name="password">
		        		</div>
		        		<div id="change" class="col-md-1">
		        			<button type="button" class="btn btn-success">Change</button>
		        		</div>
		        	</div>
		    	</div>
		    	<div class="modal-footer">
		    		<button type="button" class="btn btn-danger" data-dismiss="modal" id="delete">Delete</button>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			        <button type="submit" class="btn btn-primary" id="save">Save</button>
		    	</div>
		    	</form>
		    </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2 sidebar">
			<a href="<?php echo current_url(); ?>">
				<div class="sidebar-header">
					<h2>Admin</h2>
					<p>Halo, <?php echo $nama;?></p>
				</div>
			</a>
			<hr>
			<ul class="links list-unstyled">
				<li class="menu" id="lpb"><a href="#lpb">LPB Bahan</a></li>
				<li class="menu" id="stock"><a href="#stock">Stock Bahan</a></li>
				<li class="menu" id="permintaan"><a href="#permintaan">Permintaan Bahan Baku</a></li>
				<!--<li class="menu" id="data"><a href="#data">Data Bahan</a></li>-->
				<li class="menu" id="akun"><a href="#akun"><span>Kelola Akun</span></a></li>
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
		<div class="col-md-10 offset-md-2 main">
			<?php
				echo "<div class='error_msg'>";
				if (isset($message_display)) {
					echo $message_display;
				}
				echo "</div>";
			?>
			<div id="lpb-content" class="content">
				<ul class="nav nav-tabs nav-fill justify-content-center mb-3" id="lpb-tab">
					<li class="nav-item">
						<a class="nav-link" id="baku-lpb" href="#lpb-baku">LPB Bahan Baku</a>
					</li>
					<li class="nav-item">
				    	<a class="nav-link" id="kemas-lpb" href="#lpb-kemas">LPB Bahan Kemas</a>
					</li>
					<li class="nav-item">
				    	<a class="nav-link" id="bantu-lpb" href="#lpb-bantu">LPB Bahan Pembantu</a>
					</li>
				</ul>
				<div class="tab-content" id="lpb-tab-content">
					<div class="lpb-tab tab-pane" id="lpb-baku"><?=$contents['lpb_baku']?></div>
					<div class="lpb-tab tab-pane fade" id="lpb-kemas"><?=$contents['lpb_kemas']?></div>
					<div class="lpb-tab tab-pane fade" id="lpb-bantu"><?=$contents['lpb_bantu']?></div>
				</div>
			</div>
			<div id="stock-content" class="content">
				<ul class="nav nav-tabs nav-fill justify-content-center mb-3" id="stock-tab">
					<li class="nav-item">
						<a class="nav-link" id="baku-stock" href="#stock-baku">Stock Bahan Baku</a>
					</li>
					<li class="nav-item">
				    	<a class="nav-link" id="kemas-stock" href="#stock-kemas">Stock Bahan Kemas</a>
					</li>
				</ul>
				<div class="tab-content" id="stock-tab-content">
					<div class="stock-tab tab-pane" id="stock-baku"><?=$contents['stock_baku']?></div>
					<div class="stock-tab tab-pane fade" id="stock-kemas"><?=$contents['stock_kemas']?></div>
				</div>
			</div>
			<div id="permintaan-content" class="content">
				<?=$contents['permintaan_baku']?>
			</div>
			<div id="data-content" class="content">
				<div class="row button-container mr-0">
					<div class="col">
						<button class="btn btn-block" onclick="location.href='<?php echo base_url();?>Admin/add_data_bahan_baku_show'"; >Tambah Data Bahan Baku</button>
					</div>
					<div class="col">
						<button class="btn btn-block" onclick="location.href='<?php echo base_url();?>Admin/add_data_bahan_kemas_show'"; >Tambah Data Bahan Kemas</button>
					</div>
				</div>
			</div>
			<div id="akun-content" class="content">
				<?=$contents['akun']?>
			</div>
		</div>
	</div>
</body>