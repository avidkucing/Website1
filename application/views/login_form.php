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
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<!--Bootstrap 4-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
		<!--Icons-->
		<script defer src="<?php echo base_url(); ?>public/js/fontawesome-all.js"></script>
		<!--Our Custom CSS-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/login_form.css">
	</head>
	<body>
		<?php
		if (isset($logout_message)) {
			echo "<div class='message alert alert-danger'>";
			echo $logout_message;
			echo "</div>";
		}
		?>
		<?php
		if (isset($message_display)) {
			echo "<div class='message alert alert-danger'>";
			echo $message_display;
			echo "</div>";
		}
		?>
		<?php echo form_open('user_authentication/user_login_process'); ?>
		<?php
				
				if (isset($error_message)) {
					echo "<div class='error_msg alert alert-danger'>";
				echo $error_message;
			}
			echo validation_errors();
			echo "</div>";
		?>
		<div class="container">
			<div class="row" id="main">
				<div class="col">
					
				</div>
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
				<div class="col">
					
				</div>
				<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</body>
</html>