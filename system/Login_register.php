<?php
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
    if (isset($data['action']) && $data['action'] == 'login') {
      $this->loginAction($data);
    }
    elseif (isset($data['action']) && $data['action'] == 'registration') {
      $this->registerAction($data);
    }
    elseif (isset($data['action']) && $data['action'] == 'edit') {
      $this->editAction($data);
    }
    elseif (isset($data['action']) && $data['action'] == 'delete') {
      $this->deleteAction($data);
    }
    elseif (isset($data['action']) && $data['action'] == 'pwd') {
      $this->changePwdAction($data);
    }
    else {
      session_destroy();
      header('Location: ../application/login.php');
    }
  }

  function loginAction($data){
    $errors = array();
    $email = $data['email'];
    $password = $data['password'];
    if (!(isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL))) {
      $errors[] = "Email ".$email." not valid";
    }
    if (!(isset($password) && strlen($password)>6)) {
      $errors[] = "Password not valid";
    }
    if (count($errors)>0) {
      $_SESSION['errors'] = $errors;
      header('Location: ../application/login.php');
    }
    else {
      $query = "SELECT * FROM users WHERE email='".
        mysql_real_escape_string($email)."' AND password='".
        mysql_real_escape_string($password)."'";
      $user = $this->connection->fetch_all($query);
      if (count($user)>0) {
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $user[0]['id'];
        $_SESSION['user_name'] = $user[0]['user_name'];
        $_SESSION['first_name'] = $user[0]['first_name'];
        $_SESSION['last_name'] = $user[0]['last_name'];
        $_SESSION['email'] = $user[0]['email'];
        header('Location: ../application/home.php');
      }
      else {
        $errors[] = "Email or Password not valid";
        $_SESSION['errors'] = $errors;
        header('Location: ../application/login.php');
      }
    }
  }

  function registerAction($data){
    $errors = array();

    $user_name = $data['user_name'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $password = $data['password'];
    $conf_password = $data['conf_password'];

    if (!(isset($user_name) && is_string($user_name) && strlen($user_name)>0)) {
      $errors[] = "Username too short";
    }
    if (!(isset($first_name) && is_string($first_name) && strlen($first_name)>0)) {
      $errors[] = "First Name too short";
    }
    if (!(isset($last_name) && is_string($last_name) && strlen($last_name)>0)) {
      $errors[] = "Last Name too short";
    }
    if (!(isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL))) {
      $errors[] = "Email not valid";
    }
    if (!(isset($password) && strlen($password)>6)) {
      $errors[] = "Password needs a least 6 characters. Your password had ".strlen($password)." characters.";
    }
    if (!(isset($conf_password) && $password == $conf_password)) {
      $errors[] = "Confirmed password not equal to password";
    }
    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      header('Location: ../application/login.php');
    }
    else {
      $query = "SELECT * FROM users WHERE email = '".
        mysql_real_escape_string($email) ."' OR user_name = '".
        mysql_real_escape_string($user_name)."'";
      $user = $this->connection->fetch_all($query);

      if (count($user)>0) {
        $errors[] = "Account with email ".$email." or user_name ".$user_name." already exists.";
        $_SESSION['errors'] = $errors;
        header('Location: ../application/login.php');
      }
      else {
        $query = "INSERT INTO users (user_name, first_name, last_name, email, password, created_at) VALUES ('".
          mysql_real_escape_string($user_name)."', '".
          mysql_real_escape_string($first_name)."', '".
          mysql_real_escape_string($last_name)."', '".
          mysql_real_escape_string($email)."', '".
          mysql_real_escape_string($password)."', NOW())";
        mysql_query($query);

        $success[] = "Registration successfull! Have fun :)";
        $_SESSION['messages'] = $success;
        $this->loginAction($data);
      }
    }
  }

  function editAction($data) {
    $user_name = $data['user_name'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $id = $data['id'];
    $errors = array();
    if (strlen($user_name) == 0) {
      $user_name = $_SESSION['user_name'];
    }
    else {
      if (!(is_string($user_name) && strlen($user_name)>0)) {
        $errors[] = "Username too short";
      }
    }
    if (strlen($first_name) == 0) {
      $first_name = $_SESSION['first_name'];
    }
    else {
      if (!(is_string($first_name) && strlen($first_name)>0)) {
        $errors[] = "First Name too short";
      }
    }
    if (strlen($last_name) == 0) {
      $last_name = $_SESSION['last_name'];
    }
    else {
      if (!(is_string($last_name) && strlen($last_name)>0)) {
        $errors[] = "Last Name too short";
      }
    }
    if (strlen($email) == 0) {
      $email = $_SESSION['email'];
    }
    else {
      if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $errors[] = "Email not valid";
      }
    }

    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      header('Location: .../application/edit.php');
    }
    else {
      $query = "UPDATE users SET user_name='".
        mysql_real_escape_string($user_name)."', first_name='".
        mysql_real_escape_string($first_name)."', last_name='".
        mysql_real_escape_string($last_name)."', email='".
        mysql_real_escape_string($email)."' where id=".
        mysql_real_escape_string($id);
      mysql_query($query);
      
      $query = "SELECT * FROM users WHERE id=".
        mysql_real_escape_string($id);
      $user = $this->connection->fetch_all($query);

      $_SESSION['user_name'] = $user[0]['user_name'];
      $_SESSION['first_name'] = $user[0]['first_name'];
      $_SESSION['last_name'] = $user[0]['last_name'];
      $_SESSION['email'] = $user[0]['email'];

      $success[] = "Account update successfull!";
      $_SESSION['messages'] = $success;
      header('Location: ../application/edit.php');
    }
  }

  function changePwdAction($data) {
    $errors = array();
    $success = array();
    $new_password = $data['new_password'];
    $conf_password = $data['conf_password'];
    $password = $data['password'];
    $id = $data['id'];

    if (!(isset($new_password) && strlen($new_password)>6)) {
      $errors[] = "New password needs a least 6 characters. Your new password had ".
        strlen($new_password)." characters.";
    }
    if (!(isset($conf_password) && $new_password === $conf_password)) {
      $errors[] = "Confirmed password not equal to password";
    }
    if (!(isset($password) && strlen($password)>6)) {
      $errors[] = "Password is empty!";
    }
    if (count($errors) > 0){
      $_SESSION['errors'] = $errors;
      header('Location: ../application/edit.php');
    }
    else {
      $query = "SELECT * FROM users WHERE password= '".
        mysql_real_escape_string($password)."' AND id= ".
        mysql_real_escape_string($id);

      $user = $this->connection->fetch_all($query);
      
      if (count($user)==0) {
        $errors[] = "Password is incorrect!";
        $_SESSION['errors'] = $errors;
        header('Location: ../application/login.php');
      }
      else {
        $query = "UPDATE users SET password='".
          mysql_real_escape_string($new_password)."' where id= ".
          mysql_real_escape_string($id);
        mysql_query($query);

        $success[] = "Password update successfull!";
        $_SESSION['messages'] = $success;
        header('Location: ../application/edit.php');
      }
    }
  }

  function deleteAction($data) {
    $id = $data['id'];
    $query = "DELETE FROM users WHERE id= ".
      mysql_real_escape_string($id);
    mysql_query($query);

    session_destroy();
    header('Location: ../application/home.php');
  }
}
