<?php
	session_start();
	include('connection.php');
    require('header.php');
    require_once('picture.php');

    // $person = Person::currentUser();


    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $person->becomeFriendsWith($_POST['action']);
      exit();
    }
?>
    <style type="text/css">
        #row {
            margin-top: 20px;
        }
    </style>
    <div class='container' id='dropdown'>
        <div class="btn-group" id='dropdown2'>
          <button type="button" class="btn btn-default" id='btn'>Choose you city</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" id='menu' role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">San Francisco</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Berlin</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Bern</a></li>
            <li role="presentation" class="divider"></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
          </ul>
        </div>
        <!-- table -->
        <div class='row' id='row'>

        <?php

        $pics = new Picture();
        $images = $pics->getRandomPics('37.779', '-122.420', '75');
        // var_dump($images);
        if($images === false) {
            echo 'Flickr Feed Unavailable';
        }
        else {
            foreach($images['photos']['photo'] as $photo) {
                echo '<a href="detail.php" value="' . $photo['owner'] . '/' . $photo['id'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_s.jpg" /></a>';
                // echo '<a href="http://flickr.com/photos/' . $photo->attributes()->owner . '/' . $photo->attributes()->id . '"><img src="http://farm' . $photo->attributes()->farm . '.static.flickr.com/' . $photo->attributes()->server . '/' . $photo->attributes()->id . '_' . $photo->attributes()->secret . '_s.jpg" /></a>';

            }
        }
?>




        </div>
        <hr>
		<footer>Made with love by Thereza, 2013</footer><br>
	</div>
</body>
</html>