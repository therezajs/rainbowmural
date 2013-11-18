<?php
	session_start();
	include('connection.php');
    require('header.php');
    require_once('picture.php');

?>
    <style type="text/css">
        html { height: 100% }
        body { height: 100%; margin: 0; padding: 0 }
        #map {
            height: 300px;
        }
        #map-canvas { height: 100%; }
        #cityname {
            padding: 8px;
        }
        .item {
            width: 32%;
        }
        .item img {
            width: 100%;
            padding: 8px;
        }
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

    <script type="text/javascript">
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng("<?php echo $_GET['lat']?>","<?php echo $_GET['lon']?>"),
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
        photos.forEach(function(each) {
            var ll = new google.maps.LatLng(each.latitude,each.longitude);
            var marker = new google.maps.Marker({
                position: ll,
                map: map,
                title: each.title
            });
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <div class="container" id='container'>

        <div class="row">
            <div class='col-md-8' id='cityname'>
                <h2><?php
                if (isset($_GET['place'])) {
                    echo $_GET['place'];
                }
                else
                {
                    echo "Choose your city";
                } ?></h2>
            </div>
            <div class='col-md-8' id='pic_container'>

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
                echo '<div class="item"><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '_' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a></div>';
                // <a class="title" href="detail.php?id=' . $photo['id'] . '_' . $photo['secret'] . '">'.$photo['title'].'</a>
            }

            echo "<script>var photos = JSON.parse('".addslashes(json_encode($images['photos']['photo']))."');</script>";

        }

    }
?>
            </div>
            <div class='col-md-4' id='map'>


                <div id="map">
                    <div id="map-canvas"/>
                </div>
            </div>
        </div>


    </div>
    <script type="text/javascript">
            $(window).load(function() {
                var container = document.querySelector('#pic_container');
                var msnry = new Masonry( container, {
                  itemSelector: '.item'
                });
            });
        </script>
</body>
</html>