<?php
	session_start();
	include('connection.php');
	require('header.php');


?>

	<style type="text/css">
	#submit {
		margin-top: 10px;
	}
	#container {
		margin-top: 60px;
	}
	</style>


	<div class='container' id='container'>
		<?php
			if (isset($_SESSION['errors'])) {
				foreach ($_SESSION['errors'] as $error) {
					echo "<div class='alert alert-danger'>".$error."</div>";
				}
				unset($_SESSION['errors']);
			};

			if (isset($_SESSION['messages'])) {
				foreach ($_SESSION['messages'] as $message) {
					echo "<div class='alert alert-success'>".$message."</div>";
				}
				unset($_SESSION['messages']);
			};
		?>
		<div class='row'>
			<div class='box col-md-6'>
				<h3>Register</h3>
				<form action='login_register.php' method='post' id='registration' role='form'>
					<input type='hidden' name='action' value='registration'>
					<div class='form-group'>
						<input type='text' placeholder='Username' name='name' class="form-control">
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
				<form action='login_register.php' method='post' id='login' role='form'>
					<input type='hidden' name='action' value='login'>
					<div class='form-group'>
					<input type='text' placeholder='Email' name='email' class="form-control">
					</div>
					<div class='form-group'>
					<input type='password' placeholder='Password' name='password' class="form-control">
					</div>
					<input type='submit' value='Login' class='btn btn-success'>
				</form>
				<form action='login_register.php' method='post' role='form'>
					<div id='submit'>
					<input type='submit' value='Log off' class='btn btn-danger'>
					</div>
				</form>
			</div>
		</div>
		<hr>
		<footer>Made with love by Thereza, 2013</footer>
	</div>
</body>
</html>