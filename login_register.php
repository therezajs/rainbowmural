<?php
	include("Database.php");
	session_start();

	class LoginController {

		private $connection;

		function __construct() {

			// In a constructor every property gets its value. No property should be null.
			// A constructor must not do anything beside that: no side-effects.

			$this->connection = new Database();

		}

		function processFormData($data) {

			// Law of Demeter: objects only talk to their friends. Friends are $this, properties,
			// method arguments (if any of these is an array, its elements are friends too.)
			// Friends of friends are not friends, avoid method chaining.

			if (isset($data['action']) && $data['action'] == 'login')
			{
				$this->loginAction($data);
			}
			elseif (isset($data['action']) && $data['action'] == 'registration')
			{
				$this->registerAction($data);
			}
			else
			{
				session_destroy();
				header('Location: login.php');
			}
		}

		function loginAction($data){
			$errors = array();

			if (!(isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL))){
				$errors[] = "Email not valid";
			}

			if (!(isset($data['password']) && strlen($data['password'])>6)){
				$errors[] = "Password not valid";
			}

			if (count($errors)>0) {

				$_SESSION['errors'] = $errors;
				header('Location: login.php');
			}
			else
			{
				$query = "SELECT * FROM users WHERE email='{$data['email']}' AND password='{$data['password']}'";
				$user = $this->connection->fetch_all($query);

				if (count($user)>0){

					$_SESSION['logged_in'] = true;
					$_SESSION['id'] = $user[0]['id'];
					$_SESSION['user_name'] = $user[0]['user_name'];
					$_SESSION['first_name'] = $user[0]['first_name'];
					$_SESSION['last_name'] = $user[0]['last_name'];
					$_SESSION['email'] = $user[0]['email'];
					// $_SESSION['messages'][] = "You've logged in successfully!";
					header('Location: index.php');
				}
				else
				{
					$errors[] = "Email or Password not valid";
					$_SESSION['errors'] = $errors;
				}
			}
		}

		function registerAction($data){
			$errors = array();

			if (!(isset($data['user_name']) && is_string($data['user_name']) && strlen($data['user_name'])>2)) {
				$errors[] = "Username not valid";
			}

			if (!(isset($data['first_name']) && is_string($data['first_name']) && strlen($data['first_name'])>2)) {
				$errors[] = "First Name not valid";
			}

			if (!(isset($data['last_name']) && is_string($data['last_name']) && strlen($data['last_name'])>2)) {
				$errors[] = "Last Name not valid";
			}

			if (!(isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL))) {
				$errors[] = "Email not valid";
			}

			if (!(isset($data['password']) && strlen($data['password'])>6)) {
				$errors[] = "Password not valid";
			}

			if (!(isset($data['conf_password']) && $data['password'] == $data['conf_password'])) {
				$errors[] = "Confirmed password not equal to password";
			}

			if (count($errors) > 0){
				$_SESSION['errors'] = $errors;
				header('Location: login.php');
			}
			else
			{
				$query = "SELECT * FROM users WHERE email = '{$data['email']}' OR user_name = '{$data['user_name']}'";
				$user = $this->connection->fetch_all($query);

				if (count($user)>0) {

					$errors[] = "Account with email ".$data['email']." or user_name ".$data['user_name']."already exists.";
					$_SESSION['errors'] = $errors;
					header('Location: login.php');
				}
				else
				{
					$query = "INSERT INTO users (user_name, first_name, last_name, email, password, created_at) VALUES ('{$data['user_name']}', '{$data['first_name']}', '{$data['last_name']}', '{$data['email']}', '{$data['password']}', NOW())";
					mysql_query($query);

					$success[] = "Registration successfull!";
					$_SESSION['messages'] = $success;
					header('Location: login.php');
				}
			}
		}
	}


$login = new LoginController();
$login->processFormData($_POST);

