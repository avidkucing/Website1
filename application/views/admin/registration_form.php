<html>
<?php
	//if (isset($this->session->userdata['logged_in'])) {
	//	header("location: http://localhost/login/user_authentication/user_login_process");
	//}
?>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="main">
		<div id="login">
			<h2>Registration Form</h2>
		<hr/>
		<?php
			echo "<div class='error_msg'>";
			echo validation_errors();
			echo "</div>";
			echo form_open('admin/new_user_registration');


			$opsipegawai = array(
		        'Gudang'         					=> 'Gudang',
		        'Quality Control'           		=> 'Quality Control',
		        'Quality Assurance'         		=> 'Quality Assurance',
		        'Produksi'       					=> 'Produksi',
		        'Kepala Bagian Quality Control'     => 'Kepala Bagian Quality Control',
		        'Kepala Bagian Quality Assurance'   => 'Kepala Bagian Quality Assurance',
			);
			echo form_label('Tipe Pegawai : ');
			echo"<br/>";
			echo form_dropdown('tipe', $opsipegawai, 'Gudang'); //default selected : gudang
			echo"<br/>";
			echo"<br/>";
			echo form_label('Nama : ');
			echo"<br/>";
			echo form_input('nama');
			echo"<br/>";
			echo"<br/>";
			echo form_label('Username : ');
			echo"<br/>";
			echo form_input('username');
			echo "<div class='error_msg'>";
			if (isset($message_display)) {
				echo $message_display;
			}
			echo "</div>";
			echo"<br/>";
			echo form_label('Email : ');
			echo"<br/>";
			$data = array(
			'type' => 'email',
			'name' => 'email_value'
			);
			echo form_input($data);
			echo"<br/>";
			echo"<br/>";
			echo form_label('Password : ');
			echo"<br/>";
			echo form_password('password');
			echo"<br/>";
			echo"<br/>";
			echo form_submit('submit', 'Sign Up');
			echo form_close();
		?>
		</div>
	</div>
</body>
</html>