<!DOCTYPE html>
<html>
	<?php
		if (isset($this->session->userdata['logged_in'])) {
			header("location: http://localhost/login/User_Authentication/user_login_process");
		}
	?>
	<head>
		<title>Login</title>
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
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/login_form.css">
	</head>
	<body>
		<?php
			if (isset($logout_message)) {
				echo "<div class='message alert alert-info'>";
				echo $logout_message;
				echo "</div>";
			}
		?>
		<?php
			if (isset($error_message)) {
				echo "<div class='error_msg alert alert-danger'>";
				echo $error_message;
				echo "</div>";
			}
		?>
		<div class="row" id="main">
			<div class="col"></div>
			<div class="col">
				<?php echo form_open('user_authentication/user_login_process'); ?>
				<div id="text-input" class="col">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><span class="fas fa-user"></span></span>
						</div>
						<input type="text" name="username" value="<?php echo set_value('username'); ?>" id="name" class="form-control" placeholder="Username" required/>
					</div>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><span class="fas fa-key"></span> </span>
						</div>
						<input type="password" name="password" value="<?php echo set_value('password'); ?>" id="password" class="form-control" placeholder="Password" required/>
					</div>
					<br>
					<button type="button submit" class="btn">Login</button>
				</div>
				<?php echo form_close(); ?>
			</div>
			<div class="col"></div>
		</div>
	</body>
</html>