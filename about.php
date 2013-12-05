<?php
	session_start();
	include("Database.php");
    require('header.php');

    // $person = Person::currentUser();


    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $person->becomeFriendsWith($_POST['action']);
      exit();
    }
?>

    <div class="container">
      <?php
        flash();
      ?>
    </div>
</body>
</html>
