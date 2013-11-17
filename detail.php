<?php
	session_start();
	include('connection.php');
    require('header.php');
    require_once('comment.php');
    require_once('picture.php');

    // $comment = Comment::currentUser();
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_comment = new Comment();
        $new_comment->processFormData($_POST);
        exit();
    }


?>



    <script type="text/javascript">
        var geocoder;
        var map;
        var lat;
        var lon;
        function initialize() {
            geocoder = new google.maps.Geocoder();
            lat = photo.location.latitude;
            lon = photo.location.longitude;
        var mapOptions = {
          center: new google.maps.LatLng(photo.location.latitude,photo.location.longitude),
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
            var ll = new google.maps.LatLng(photo.location.latitude,photo.location.longitude);
            var marker = new google.maps.Marker({
                position: ll,
                map: map,
                title: "Hello World!"
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


    </script>
    <style type="text/css">
        html { height: 100% }
        body { height: 100%; margin: 0; padding: 0 }
        #map-canvas { height: 100%; border: 1px solid black; }

        #container {
            margin-top: 70px;
        }
        #location_heigth {
            height: 80px;
        }
        #map {
            height: 300px;
        }
    </style>
    <div class="container" id='container'>
        <div class='row'>
            <div class='col-md-6' id='pic'>
                <?php
                    $photo_id = $_GET['id'];
                    $id = explode('_', $photo_id);
                    echo '<img src="http://www.flickr.com/photos/'.$photo_id.'.jpg">';
                ?>


            </div>
            <div class='col-md-6'>
                <?php
                    $pics = new Picture();
                    $images = $pics->getPicInfo($id[0]);
                    // var_dump($images);
                    echo "<script>var photo = JSON.parse('".addslashes(json_encode($images['photo']))."');</script>";

                    if($images === false) {
                        echo 'Flickr Feed Unavailable';
                    }
                    else {
                        echo '<h3>'.$images['photo']['title']['_content'].'</h3>';
                    }
                ?>

                <div id='location_heigth'>
                <div id='location'></div>
                </div>
                <br>
                <div id='map'>
                    <div id="map-canvas"/>
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
                        $html = "<table class='table table-bordered'><tbody>";
                        foreach($comments as $comment)
                        {
                            $html .= "<tr><td>".$comment->name."</td>";
                            $html .= "<td>".$comment->comment."</td>";
                        }
                        $html .= "</tbody></table>";
                        echo $html;
                    }
                    $get_comments = new Comment();
                    $comments = $get_comments->getComments($id[0]);
                    var_dump($comments);
                    commentsTable($comments);

                    ?>


                    <form action="<? echo $_SERVER['PHP_SELF']."?id=".$photo_id ?>" method="post" >
                        <input type='hidden' name='pic_id' value='<?php echo $id[0] ?>'>
                        <input type='hidden' name='pic_secret' value='<?php echo $photo_id ?>'>
                        <input type='hidden' name='action' value='comment' >
                        <?php
                            if (isset($_SESSION['logged_in'])) {
                                echo "<input type='hidden' name='user_id' value=". $_SESSION['id'] .">";
                                echo "<textarea name='comment'></textarea>";
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







    </script>

</body>
</html>