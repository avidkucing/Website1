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

			echo form_label('Kode Bahan: ');
			echo"<br/>";
			echo form_input('kode');
			echo"<br/>";
			echo form_label('Nama Bahan: ');
			echo"<br/>";
			echo form_input('nama');
			echo"<br/>";
			echo form_label('Satuan: ');
			echo"<br/>";
			echo form_input('satuan');
			echo"<br/>";
			echo form_label('Jenis: ');
			echo"<br/>";
			echo my_form_dropdown('jenis', array('Baku', 'Kemas', 'Pembantu'), 'Baku'); 
			echo form_submit('submit', 'Selanjutnya');
			echo form_close();
		?>
		</div>
	</div>
</body>
</html>