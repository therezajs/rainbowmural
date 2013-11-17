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
    <link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYEdp4vZEKpPU4nbucnDEAwzvCgyXCDhQ&sensor=false"></script>
    <script type="text/javascript" scr="masonry.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <style type="text/css">
        #my_container {
            margin-top: 100px;
        }
        #btn {
            min-width: 300px;
            text-align: left;
        }
        #menu {
            min-width: 300px;
            text-align: left;
        }
    </style>
    <script type="text/javascript">

    </script>
</head>
<body>
	<div class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Street Art of the World powered by</a><a class="navbar-brand" href="http://www.flickr.com"><strong style="color:#3993ff">flick<span style="color:#ff1c92">r</span></strong></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">home</a></li>
                    <li><a href="map.php">map</a></li>
                    <li><a href="about.php">about</a></li>
                    <li><a href="login.php">login</a></li>
                </ul>
                <?php if (isset($_SESSION['logged_in'])) {
                    echo '<ul class="nav navbar-nav navbar-right">';
                    echo "<li><a href='edit.php'>Welcome ". $_SESSION['user_name']."</a></li>";
                    echo "<li><form action='login_register.php' method='post' class='navbar-form navbar-right'>";
                    echo "<div id='form-group'>";
                    echo "<input type='submit' value='Log off' class='btn btn-danger form-control'></div></form></li></ul>";
                }
                ?>
            </div>
        </div>
    </div>