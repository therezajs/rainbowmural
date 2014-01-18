<?php
	session_start();
	include("Database.php");
	require('header.php');
?>
	<div class='container' id='my_container'>
		<?php
			flash();
		?>

		<div class='row'>
			<?php
            if (isset($_SESSION['logged_in'])): ?>
				<form action='login_register.php' method='post' role='form'>
					<div id='submit'>
					<input type='submit' value='Log off' class='btn btn-danger'>
					</div>
				</form>
			<?php else: ?>
				<div class='box col-md-6'>
					<h3>Register</h3>
					<form action='Login_register.php' method='post' id='registration' role='form'>
						<input type='hidden' name='action' value='registration'>
						<div class='form-group'>
							<input type='text' placeholder='Username' name='user_name' class="form-control">
						</div>
						<div class='form-group'>
							<input type='text' placeholder='First name' name='first_name' class="form-control">
						</div>
						<div class='form-group'>
							<input type='text' placeholder='Last name' name='last_name' class="form-control">
						</div>
						<div class='form-group'>
							<input type='text' placeholder='Email' name='email' class="form-control">
						</div>
						<div class='form-group'>
							<input type='password' placeholder='Password' name='password' class="form-control">
						</div>
						<div class='form-group'>
							<input type='password' placeholder='Confirm Password' name='conf_password' class="form-control">
						</div>
						<input type='submit' value='Register' class='btn btn-success'>
					</form>
				</div>
				<div class='box col-md-6'>

				<h3>Login</h3>
					<form action='Login_register.php' method='post' id='login' role='form'>
						<input type='hidden' name='action' value='login'>
						<div class='form-group'>
						<input type='text' placeholder='Email' name='email' class="form-control">
						</div>
						<div class='form-group'>
						<input type='password' placeholder='Password' name='password' class="form-control">
						</div>
						<input type='submit' value='Login' class='btn btn-success'>
					</form>
				</div>
			<?php endif; ?>
		</div>
<?php require('footer.php'); ?>
