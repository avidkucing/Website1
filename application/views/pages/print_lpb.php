<!doctype html>

<head>
	<title>Print LPB</title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/lpb.css">
</head>

<body>
	<div id="print-content">
		<p class="title print-only" style="display: none;">PT. Hisamitsu Pharma Indonesia</p>
		<br>
		<div class="row">
			<div class="col-md-4 offset-md-1">
				<p><a class="font-weight-bold">No. LPB:</a> <?php echo $lpb[0]['Nomor_LPB']?></p>
				<p><a class="font-weight-bold">Tanggal Terima:</a> <?php echo $lpb[0]['Tanggal_Terima']?></p>
				<p><a class="font-weight-bold">No. Surat Pesanan:</a> <?php echo $lpb[0]['Nomor_Surat']?></p>
			</div>
			<div class="col-md-4 offset-md-2">
				<p><a class="font-weight-bold">Nama Supplier:</a> <?php echo $lpb[0]['Nama_Supplier']?></p>
				<p><a class="font-weight-bold">Nama Manufacturer:</a> <?php echo $lpb[0]['Nama_Manufacturer']?></p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-10 offset-md-1">
			<?php
			$template = array(
			    'table_open' => '<table class="table table-bordered" cell-spacing="0">'
				);
				$this->table->set_template($template);
				$this->table->set_heading('Kode', 'Nama Bahan', 'Nomor Batch', 'Jumlah', 'Satuan');

				foreach ($lpb_batch as $row) {
					$this->table->add_row( $lpb[0]['Kode_Bahan'], $lpb[0]['Nama_Bahan'], $row['Nomor_Batch'], $row['Jumlah'], $lpb[0]['Satuan']);
				}
				echo $this->table->generate();
		 	?>
			</div>
		</div>

		<p class="right-item sign print-only" style="display: none;">Signed By (Electronic Sign)</p>
	</div>

	<?php
	if($tipe == 'Administrator') {
		echo '<div class="row mt-3">
			<div class="col-md-1 offset-md-5 p-1">
				<button onclick="editThis()" type="button" class="btn btn-block btn-primary">Edit</button>
			</div>
			<div class="col-md-1 p-1">
				<button onclick="deleteThis()" type="button" class="btn btn-block btn-danger">Delete</button>
			</div>
		</div>';
	}
	?>

	<div class="row mt-3">
		<div class="col-md-1 offset-md-5 p-1">
			<button onclick="printThis()" type="button" class="btn btn-block btn-success">Print</button>
		</div>
		<div class="col-md-1 p-1">
			<button onclick="history.back()" type="button" class="btn btn-block btn-secondary">Back</button>
		</div>
	</div>

	

	<script type="text/javascript">
		function printThis() {
			$('button').hide();
			$('.print-only').show();
			window.print();
			$('button').show();
			$('.print-only').hide();
		}

		function deleteThis(){
	        var no_lpb = '<?php echo $lpb[0]['Nomor_LPB']?>';

	        $.ajax({
	            url : "<?php echo base_url(); ?>Pages/delete_lpb",
	            type: "post",
	            data: {
	                "Nomor_LPB":no_lpb,
	            }
	        })
	        
	        window.history.back();
    	}

    	function editThis() {
	        //$link = "<?php echo base_url(); ?>Pages/edit_lpb/" + "<?php echo $lpb[0]['Nomor_LPB']?>";
	        //window.location.href=$link;
	        $link = "<?php echo base_url(); ?>Pages/error_wip/";
	        window.location.href=$link;
    	}
	</script>
</body>