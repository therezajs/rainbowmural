<?php
	session_start();
	include("Database.php");
    require('header.php');
?>

    <div class="container" id="my_container">
      <?php
        flash();
      ?>

	    <h2><?php echo $_SESSION['user_name'] ?></h2>

	    <p><strong>Name:</strong>
	    	<?php echo $_SESSION['first_name'] ." ".$_SESSION['last_name'] ?>
	    </p>
	    <p><strong>Email Address:</strong>
	    	<?php echo $_SESSION['email'] ?>
	    </p>

	    <form action='Login_register.php' method='post' class='navbar-form navbar-right'>
        	<input type='submit' value='Log off' class="btn btn-primary btn_left"></div>
        </form>
    </div>
<?php require('footer.php'); ?>
