<html>
<?php
	//if (isset($this->session->userdata['logged_in'])) {
	//	header("location: http://localhost/login/user_authentication/user_login_process");
	//}
?>
<head>
	<title>Formulir Input Parameter dan Spesifikasi Data Bahan Baku</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/js/parameter.js"></script>
</head>
<body>
	<div id="main">
		<div id="login">
			<h2>Formulir Input Parameter dan Spesifikasi Data Bahan Baku</h2>
		<hr/>
		<input type="button" value="Add Parameter" onClick="addRow('dataTable')" /> 
 		<input type="button" value="Remove Parameter" onClick="deleteRow('dataTable')" /> 
 		<p>(All acions apply only to entries with check marked check boxes only.)</p>
		<?php
			$template = array(
	        'table_open'            => '<table id="dataTable" border="1" cellpadding="4" cellspacing="0">'
			);

			$this->table->set_template($template);


			echo "<div class='error_msg'>";
			echo validation_errors();
			echo "</div>";

			echo form_open('admin/new_parameter_data_bahan');

			echo form_hidden('kode', $Kode_Bahan);
			$parameter = array(
            array(form_checkbox('chk[]', 'accept', TRUE), form_input('param[]'), form_input('spek[]') )
        	);

			echo $this->table->generate($parameter);

			echo form_submit('submit', 'Selesai');
			echo form_close();
		?>
		</div>
	</div>
</body>
</html>