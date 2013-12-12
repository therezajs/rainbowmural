<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>Street Art Explorer</title>
    <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYEdp4vZEKpPU4nbucnDEAwzvCgyXCDhQ&amp;sensor=false"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://masonry.desandro.com/masonry.pkgd.js"></script>
    <script src="dist/js/bootstrap.js"></script>
    <style type="text/css">
        #my_container {
          margin-top: 70px;
        }
        #btn {
            min-width: 300px;
            text-align: left;
        }
        #menu {
            min-width: 300px;
            text-align: left;
        }
        .navbar-brand {
          padding-left: 0;
        }
    </style>
    <script type="text/javascript">

    </script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Urban Rainbow<!--  by</a><a class="navbar-brand" href="http://www.flickr.com"><strong style="color:#3993ff">flick<span style="color:#ff1c92">r</span></strong> --></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="map.php">map</a></li>
              <li><a href="like.php">likes</a></li>
              <li><a href="about.php">about</a></li>
            </ul>
              <?php if ($_SERVER["REQUEST_URI"] != '/index.php'): ?>
                <form action='Picture.php' method='post' class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Choose your city" name="name">
                </div>
                <button type="submit" class="btn btn-default">Go</button>
                </form>
              <?php endif; ?>


            <ul class="nav navbar-nav navbar-right">
            <?php
            if (isset($_SESSION['logged_in'])): ?>
              <li><a href='edit.php'><?php echo $_SESSION['user_name'] ?></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="like.php">likes</a></li>
                  <li><a href="upload.php">upload</a></li>
                  <li><a href="about.php">about</a></li>
                  <li class="divider"></li>
                  <li>
                    <form action='Login_register.php' method='post' class='navbar-form navbar-right'>
                    <!-- <a href="">Log off</a> -->
                    <input type='submit' value='Log off'></div>
                    </form>
                  </li>
                </ul>
              </li>
              <?php else: ?>
              <li><a href="login.php">login or register</a></li>
              <?php endif; ?>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div>
    </nav>



<?php
    function flash(){

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

    }
?>

