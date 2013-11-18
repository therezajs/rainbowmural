<?php
	session_start();
	include('connection.php');
    require('header.php');
    require_once('picture.php');

    // $person = Person::currentUser();

?>
    <style type="text/css">
        table {
            margin: 10px auto;


        }
        td {
            border: 1px solid black;
            height: 50px;
            text-align: center;
            font-weight: bold;

        }
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

    </style>

    <div class='container' id='my_container'>
        <div id='messages'>
        <?php
        if (isset($_SESSION['messages'])) {

            foreach ($_SESSION['messages'] as $message) {
                echo "<div class='alert alert-danger'>".$message."</div>";
            }
            unset($_SESSION['messages']);
        };
        ?>

        </div>
        <div class="row">
            <div class='col-md-5' id="search">
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
        </div>
        <div class="row">
            <table class="col-md-12">
                <tbody>
                    <tr>
                        <td class="col-md-3"><a href="map.php?lat=37.779&lon=-122.420&place=San%20Francisco">San Francisco</a></td>
                        <td class="col-md-3"><a href="map.php?lat=48.856&lon=2.341&place=Paris">Paris</a></td>
                        <td class="col-md-3"><a href="map.php?lat=51.506&lon=-0.127&place=London">London</a></td>
                        <td class="col-md-3"><a href="map.php?lat=52.516&lon=13.376&place=Berlin">Berlin</a></td>
                    </tr>
                </tbody>
            </table>
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
                echo '<div class="item" ><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '_' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a></div>';
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
            });
        </script>

        <hr>
		<footer>Made with love by Thereza, 2013</footer><br>
	</div>
</body>
</html>