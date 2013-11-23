<?php
	session_start();
	include('connection.php');
    require('header.php');
    require_once('picture.php');

    // $person = Person::currentUser();

?>
    <style type="text/css">

        #search {
            margin: 10px auto;
        }
        #container {
            margin-top: 20px;
        }
        .item {
            width: 20%;
        }
        .item img {
            width: 100%;
            padding: 8px;
        }
        .button {
            min-width: 250px;
            height: 50px;
            margin: 10px;
        }
    </style>

    <div class='container' id='my_container'>
        <div id='messages'>
        <?php
            flash();
        ?>

        </div>
        <div class="row">
            <div class='col-md-4'></div>
            <div class='col-md-4' id="search">
                <form action='picture.php' method='post'>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Choose your city" name="name">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                        <input type='hidden' name='action' value='city'>
                    </div>
                </form>
            </div>
            <div class='col-md-4'></div>
        </div>
        <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav col-md-12">
            <li class='col-md-3'>
                <a class="btn btn-default button" href="map.php?lat=37.779&lon=-122.420&place=San%20Francisco">San Francisco</a>
            </li>
            <li class='col-md-3'>
                <a class="btn btn-default button" href="map.php?lat=48.856&lon=2.341&place=Paris">Paris</a>
            </li>
            <li class='col-md-3'>
                <a class="btn btn-default button"href="map.php?lat=51.506&lon=-0.127&place=London">London</a>
            </li>
            <li class='col-md-3'>
                <a class="btn btn-default button" href="map.php?lat=52.516&lon=13.376&place=Berlin">Berlin</a>
            </li>
        </ul>
        </div>
        <div id='container' class="row">

        <?php

        $pics = new Picture();
        $images = $pics->getRandomPics('30', '1');
        // var_dump($images);
        if($images === false) {
            echo 'Flickr Feed Unavailable';
        }
        else {
            foreach($images['photos']['photo'] as $photo) {
                echo '<div class="item" ><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '&secret=' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a></div>';
                // echo '<a href="http://flickr.com/photos/' . $photo->attributes()->owner . '/' . $photo->attributes()->id . '"><img src="http://farm' . $photo->attributes()->farm . '.static.flickr.com/' . $photo->attributes()->server . '/' . $photo->attributes()->id . '_' . $photo->attributes()->secret . '_s.jpg" /></a>';
            }
        }
        ?>
        </div>
        <script type="text/javascript">
            $(window).load(function() {
                var container = document.querySelector('#container');
                var msnry = new Masonry( container, {
                  itemSelector: '.item'
                });
                $(window).scroll(function() {
                    if (  document.documentElement.clientHeight +
                          $(document).scrollTop() >= document.body.offsetHeight )
                    {
                        // Display alert or whatever you want to do when you're
                        //   at the bottom of the page.
                        alert("You're at the bottom of the page.");
                    }
                });
            });
        </script>

        <hr>
		<footer>Made with love by Thereza, 2013</footer><br>
	</div>
</body>
</html>