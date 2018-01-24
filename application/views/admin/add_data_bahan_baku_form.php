<html>
<?php
	//if (isset($this->session->userdata['logged_in'])) {
	//	header("location: http://localhost/login/user_authentication/user_login_process");
	//}
?>
<head>
	<title>Formulir Input Data Bahan Baku</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="main">
		<div id="login">
			<h2>Formulir Input Data Bahan Baku</h2>
		<hr/>
		<?php
			echo "<div class='error_msg'>";
			echo validation_errors();
			echo "</div>";
			echo form_open('admin/new_data_bahan');

			echo form_label('Kode Bahan Baku : ');
			echo"<br/>";
			echo form_input('kode');
			echo"<br/>";
			echo form_label('Nama Bahan Baku : ');
			echo"<br/>";
			echo form_input('nama');
			echo"<br/>";
			/*echo form_label('Merk : ');
			echo"<br/>";
			echo form_input('merk');
			echo"<br/>";
			echo form_label('Nama Manufacturer : ');
			echo"<br/>";
			echo form_input('manufacturer');
			echo"<br/>";
			echo form_label('Nama Supplier : ');
			echo"<br/>";
			echo form_input('supplier');
			echo"<br/>";*/
			echo form_label('Satuan : ');
			echo"<br/>";
			echo form_input('satuan');
			echo"<br/>";
			echo form_hidden('jenis', 'Baku');
			echo"<br/>";
			echo form_submit('submit', 'Selanjutnya');
			echo form_close();
		?>
		</div>
	</div>
</body>
</html>