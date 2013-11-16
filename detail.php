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

    </script>
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 300px; border: 1px solid black; }
    </style>





    <style type="text/css">
        #container {
            margin-top: 70px;
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
                    if($images === false) {
                        echo 'Flickr Feed Unavailable';
                    }
                    else {
                        echo '<h3>'.$images['photo']['title']['_content'].'</h3>';
                    }
                ?>

                <div id='google_maps'>
                    <h4>Location</h4>
                   <?php
                    echo $lat = $images['photo']['location']['latitude'];
                    echo '<br>';
                    echo $lon = $images['photo']['location']['longitude'];
                    echo '<br>';
                    echo $acc = $images['photo']['location']['accuracy'];
                   ?>

                    <br>
                    Get streetview (if available) to see the location!
                    <br>
                    <br>
                    <div id="map-canvas"/>

                    <br>
                </div>
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

  //     var geocoder;
  // var map;
  // var infowindow = new google.maps.InfoWindow();
  // var marker;
  // function initialize() {
  //   geocoder = new google.maps.Geocoder();
  //   var latlng = new google.maps.LatLng(40.730885,-73.997383);
  //   var mapOptions = {
  //     zoom: 8,
  //     center: latlng,
  //     mapTypeId: google.maps.MapTypeId.ROADMAP
  //   }
  //   map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
  // }

  // function codeLatLng() {
  //   var input = document.getElementById("latlng").value;
  //   var latlngStr = input.split(",",2);
  //   var lat = parseFloat(latlngStr[0]);
  //   var lng = parseFloat(latlngStr[1]);
  //   var latlng = new google.maps.LatLng(lat, lng);
  //   geocoder.geocode({'latLng': latlng}, function(results, status) {
  //     if (status == google.maps.GeocoderStatus.OK) {
  //       if (results[1]) {
  //         map.setZoom(11);
  //         marker = new google.maps.Marker({
  //             position: latlng,
  //             map: map
  //         });
  //         infowindow.setContent(results[1].formatted_address);
  //         infowindow.open(map, marker);
  //       }
  //     } else {
  //       alert("Geocoder failed due to: " + status);
  //     }
  //   });
  // }


// function initialize() {
//         var mapOptions = {
//           center: new google.maps.LatLng(lat, lon),
//           zoom: 10,
//           mapTypeId: google.maps.MapTypeId.ROADMAP
//         };
//         var map = new google.maps.Map(document.getElementById("map-canvas"),
//             mapOptions);
//       }
//       google.maps.event.addDomListener(window, 'load', initialize);

///////////////////
var myLatlng = new google.maps.LatLng('<?php echo $lat ?>','<?php echo $lon?>');
var mapOptions = {
  zoom: 13,
  center: myLatlng,
  mapTypeId: google.maps.MapTypeId.ROADMAP
}
var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

// To add the marker to the map, use the 'map' property
var marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    title:"Hello World!"
});
///////////////////



    </script>

</body>
</html>