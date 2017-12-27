<html>
	<?php
		if (isset($this->session->userdata['logged_in'])) {
			header("location: http://localhost/login/user_authentication/user_login_process");
		}
	?>
	<head>
		<title>Login</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/login_form.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
   		<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php
		if (isset($logout_message)) {
			echo "<div class='message'>";
			echo $logout_message;
			echo "</div>";
		}
		?>
		<?php
		if (isset($message_display)) {
			echo "<div class='message'>";
			echo $message_display;
			echo "</div>";
		}
		?>
		<div class="container">
			<div class="row" id="main">
				<?php echo form_open('user_authentication/user_login_process'); ?>
					<?php
						echo "<div class='error_msg'>";
						if (isset($error_message)) {
						echo $error_message;
					}
					echo validation_errors();
					echo "</div>";
				?>
				<div class="col-sm-4">
					
				</div>
				<div id="text-input" class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="username" id="name" class="form-control" placeholder="Username"/>
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
					</div>
					<br>
					<button type="button submit" class="btn">Login</button>
				</div>
				<?php echo form_close(); ?>
				</div>
			</div>
		</div>
		
	</body>
</html>