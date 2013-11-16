<?php
	session_start();
	include('connection.php');
    require('header.php');
    require_once('picture.php');

?>
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 500px; }
    </style>

    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng("<?php echo $_GET['lat']?>","<?php echo $_GET['lon']?>"),
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <style type="text/css">
        .title {
            text-decoration: none;
        }
        .row {
            padding: 10px;
        }
        #container {
            margin-top: 70px;
        }
    </style>

    <div class="container" id='container'>
        <div class="row">
            <div class='col-md-8'>
                <h2><?php
                if (isset($_GET['place'])) {
                    echo $_GET['place'];
                }
                else
                {
                    echo "No City chosen yet";
                } ?></h2>
            </div>
            <div class='col-md-4'>
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
            <div class='col-md-6'>
<?php

    if (isset($_GET['lat'])) {

        $pics = new Picture();
        $images = $pics->getCityPics($_GET['lat'], $_GET['lon'], '1');
        // var_dump($images);
        if($images === false) {
            echo 'Flickr Feed Unavailable';
        }
        else {
            foreach($images['photos']['photo'] as $photo) {


                echo '<div class="row"><a href="detail.php?id=' . $photo['id'] . '_' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_s.jpg" /></a>  <a class="title" href="detail.php?id=' . $photo['id'] . '_' . $photo['secret'] . '">'.$photo['title'].'</a></div>';
                // echo '<a href="http://flickr.com/photos/' . $photo->attributes()->owner . '/' . $photo->attributes()->id . '"><img src="http://farm' . $photo->attributes()->farm . '.static.flickr.com/' . $photo->attributes()->server . '/' . $photo->attributes()->id . '_' . $photo->attributes()->secret . '_s.jpg" /></a>';

            }


            foreach ($images['photos']['photo'] as $photo) {
                echo '<script type="text/javascript">
                    var myLatlng = new google.maps.LatLng('.$photo['latitude'].','.$photo['longitude'].');
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title:"Hello World!"
                    });</script>';

            }

        }

    }
?>
<script type="text/javascript"></script>


            </div>
            <div class='col-md-6 fixed' id='map'>
                <div id="map-canvas"/>
            </div>
        </div>


    </div>
</body>
</html>