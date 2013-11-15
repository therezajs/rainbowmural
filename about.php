<?php
	session_start();
	include('connection.php');
    require('header.php');

    // $person = Person::currentUser();


    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $person->becomeFriendsWith($_POST['action']);
      exit();
    }
?>

    <div class="container">
    </div>
</body>
</html>