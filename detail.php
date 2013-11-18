<?php
	session_start();
	// include('connection.php');
    require('header.php');
    require_once('comment.php');
    require_once('picture.php');

    // $comment = Comment::currentUser();
?>



    <script type="text/javascript">
        var geocoder;
        var map;
        var lat;
        var lon;
        function initialize() {
            geocoder = new google.maps.Geocoder();
            lat = photo.latitude;
            lon = photo.longitude;
        var mapOptions = {
          center: new google.maps.LatLng(photo.latitude,photo.longitude),
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
            var ll = new google.maps.LatLng(photo.latitude,photo.longitude);
            var marker = new google.maps.Marker({
                position: ll,
                map: map,
                title: photo.title
            });
        codeLatLng();
        }

        google.maps.event.addDomListener(window, 'load', initialize);

          function codeLatLng() {

            var latlng = new google.maps.LatLng(lat, lon);
            geocoder.geocode({'latLng': latlng}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {

                  $('#location').html((results[0].formatted_address).split(',').join('<br>'));

                }
              } else {
                alert("Geocoder failed due to: " + status);
              }
            });
          }

        $(document).ready(function(){
            $(document).on("submit", '#comment', function() {
                var form = $(this);
                $.post(
                    $(this).attr('action'), $(this).serialize(), function(param) {
                        $('#commentsTable').append(param.html);
                        $(form).each(function(){
                                this.reset();
                        })
                    }, "json");
                return false;
            });
        });
    </script>
    <style type="text/css">
        html { height: 100% }
        body { height: 100%; margin: 0; padding: 0 }
        textarea {
            border-radius: 5px;
            margin-right: 10px;
        }
        #map-canvas { height: 100%; }

        #container {
            margin-top: 70px;
        }
        #location_heigth {
            height: 80px;
        }
        #map {
            height: 300px;
        }
        img {
            width: 90%;
            margin-bottom: 20px;
        }
        .item {
            width: 30%;
        }
        .item img {
            width: 100%;
            padding: 5px;
            margin: 0;
        }
    </style>
    <div class="container" id='container'>
        <div class='row'>
            <div class='col-md-7' id='pic'>
                <?php
                    $photo_id = $_GET['id'];
                    $id = explode('_', $photo_id);
                    echo '<img src="http://www.flickr.com/photos/'.$photo_id.'.jpg">';
                ?>

                <div class='row' id='nearby_container'>

                    <?php


                    if (isset($_GET['lat'])) {

                        $pics = new Picture();
                        $nearby = $pics->getPicsNearby($_GET['lat'], $_GET['lon']);
                        // var_dump($nearby);
                        if($nearby === false) {
                            echo 'Flickr Feed Unavailable';
                        }
                        else {
                            foreach($nearby['photos']['photo'] as $photo) {
                                if ($photo['id'] != $id[0]) {
                                    echo '<div class="item"><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '_' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a></div>';
                                // <a class="title" href="detail.php?id=' . $photo['id'] . '_' . $photo['secret'] . '">'.$photo['title'].'</a>
                                }
                                else
                                {
                                    $title = $photo['title'];
                                    echo "<script>var photo = JSON.parse('".addslashes(json_encode($photo))."');</script>";
                                }

                            }

                            echo "<script>var photos = JSON.parse('".addslashes(json_encode($nearby['photos']['photo']))."');</script>";

                        }

                    }
                    ?>
                </div>
            </div>
            <div class='col-md-5'>
                <div id='map'>
                    <div id="map-canvas"/>
                </div>
                <br>
                <?php
                    // $pics = new Picture();
                    // $images = $pics->getPicInfo($id[0]);
                    // var_dump($images);
                    // echo "<script>var photo = JSON.parse('".addslashes(json_encode($images['photo']))."');</script>";

                    // if($images === false) {
                    //     echo 'Flickr Feed Unavailable';
                    // }
                    // else {
                        echo '<h3>Title: '.$title.'</h3>';
                    // }
                ?>

                <div id='location_heigth'>
                    <div id='location'></div>
                </div>
                <br>

                <div id='comments'>
                    <!-- <form class='form'>
                        <ul class='form-group'>
                            <li>like</li>
                            <li>comment</li>
                        </ul>
                    </form> -->
                    <h4>Comment</h4>
                    <?php
                    function commentsTable($comments)
                    {
                        $html = "<table class='table table-bordered' id='commentsTable'><thead><tr><th>user</th><th>comment</th></tr></thead><tbody>";
                        foreach($comments as $comment)
                        {
                            $html .= "<tr><td>".$comment['user']."</td>";
                            $html .= "<td>".$comment['comment']."</td>";
                        }
                        $html .= "</tbody></table>";
                        echo $html;
                    }
                    $get_comments = new Comment();
                    $comments = $get_comments->getComments($id[0]);
                    // var_dump($comments);
                    commentsTable($comments);

                    ?>


                    <form action="comment.php" method="post" id='comment'>
                        <input type='hidden' name='pic_id' value='<?php echo $id[0] ?>'>
                        <input type='hidden' name='pic_secret' value='<?php echo $photo_id ?>'>
                        <input type='hidden' name='action' value='comment' >
                        <?php
                            if (isset($_SESSION['logged_in'])) {
                                echo "<input type='hidden' name='user_id' value=". $_SESSION['id'] .">";
                                echo "<textarea rows='4' cols='50' name='comment'></textarea>";
                                echo "<input type='submit' value='Say It' class='btn btn-primary'>";
                            }
                            else
                            {
                                echo '<a href="login.php">Log in</a> to comment';
                            }

                        ?>
                    </form>
                </div>
            </div>
        </div>

    </div>
      <script type="text/javascript">

            $(window).load(function() {
                var container = document.querySelector('#nearby_container');
                var msnry = new Masonry( container, {
                  itemSelector: '.item'
                });
            });

    </script>

</body>
</html>