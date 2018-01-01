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
		<!--Bootstrap 3-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
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
						<input type="text" name="username" value="<?php echo set_value('username'); ?>" id="name" class="form-control" placeholder="Username"/>
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="password" value="<?php echo set_value('password'); ?>" id="password" class="form-control" placeholder="Password"/>
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