<!doctype html>

<head>
	<title>Print All</title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/edit-lpb.css">
</head>

<body>
	<h1 class="text-center">LPB Bahan <?php echo ucfirst($tipe);?></h1>
	<div class="row mt-3">
		<div class="col-md-1 offset-md-5 p-1">
			<button onclick="printThis()" type="button" class="btn btn-block btn-success">Print</button>
		</div>
		<div class="col-md-1 p-1">
			<button onclick="history.back()" type="button" class="btn btn-block btn-danger">Back</button>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-md-10 offset-md-1">
			<?=${'lpb_'.$tipe}?>
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
	</script>
</body>