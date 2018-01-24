<html>
<?php
	//if (isset($this->session->userdata['logged_in'])) {
	//	header("location: http://localhost/login/user_authentication/user_login_process");
	//}
?>
<head>
	<title>Formulir Input Manufactur dan Supplier Data Bahan Baku</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/js/parameter.js"></script>
</head>
<body>
	<div id="main">
		<div id="login">
			<h2>Formulir Input Manufactur dan Supplier Data Bahan Baku</h2>
		<hr/>
		<input type="button" value="Add Manufactur" onClick="addRow('dataTableManu')" /> 
 		<input type="button" value="Remove Manufactur" onClick="deleteRow('dataTableManu')" /> 
 		<p>(All acions apply only to entries with check marked check boxes only.)</p>
		<?php
			$template = array(
	        'table_open'            => '<table id="dataTableManu" border="1" cellpadding="4" cellspacing="0">'
			);

			$this->table->set_template($template);


			echo "<div class='error_msg'>";
			echo validation_errors();
			echo "</div>";

			echo form_open('admin/new_manu_supp_data_bahan');

			echo form_hidden('kode', $Kode_Bahan);
			$manufactur = array(
            	array(form_checkbox('chk[]', 'accept', TRUE), form_input('manu[]'))
        	);

			echo $this->table->generate($manufactur);
		?>
		<input type="button" value="Add Supplier" onClick="addRow('dataTableSupp')" /> 
 		<input type="button" value="Remove Supplier" onClick="deleteRow('dataTableSupp')" /> 
 		<p>(All acions apply only to entries with check marked check boxes only.)</p>
		<?php
			$template = array(
	        'table_open'            => '<table id="dataTableSupp" border="1" cellpadding="4" cellspacing="0">'
			);

			$this->table->set_template($template);

			echo form_hidden('kode', $Kode_Bahan);
			$supplier = array(
            	array(form_checkbox('chk[]', 'accept', TRUE), form_input('supp[]'))
        	);

			echo $this->table->generate($supplier);

			echo form_submit('submit', 'Selesai');
			echo form_close();
		?>
		</div>
	</div>
</body>
</html>