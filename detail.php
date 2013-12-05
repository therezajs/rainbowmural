<?php
	session_start();
	// include("Database.php");
    require('header.php');
    require_once('ajax_comment.php');
    require_once('ajax_like.php');
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
                title: photo.title._content
            });

            var image = 'red_dot.png';
            var current_dotMarker = null;
            photosNearby.forEach(function(each) {
                if (each.id != <?php echo "'". $_GET['id'] ."'"?>) {
                    var myLatLng = new google.maps.LatLng(each.latitude,each.longitude);
                    var dotMarker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        icon: image
                    });
                    var contentString = '<a href="detail.php?lat=' + each.latitude + '&lon=' + each.longitude + '&id=' + each.id + '&secret=' + each.secret + '"><img class="images" src="http://www.flickr.com/photos/'+each.id+'_'+each.secret+'_s.jpg"></a>';

                    var that = this;
                    that.infowindow = new google.maps.InfoWindow({
                      content: contentString
                    });

                    var infowindow = new google.maps.InfoWindow({
                      content: contentString
                    });
                    google.maps.event.addListener(dotMarker, 'mouseover', function() {

                        if(current_dotMarker && this.__gm_id != current_dotMarker.__gm_id)
                        {
                        // console.log(current_marker.__gm_id);
                            // console.log("close");
                            that.infowindow.close();
                        }
                        current_marker = marker;
                        that.infowindow.content = contentString;
                        that.infowindow.setOptions({ disableAutoPan : true });
                        that.infowindow.open(map, dotMarker);
                    });
                };
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

            $(document).on("click", '#like_button', function() {
                var form = $(this);
                $.post(
                    $(this).attr('action'), $(this).serialize(), function(param) {
                        alert("Red heart");
                        $(form).html("<button type='button' class='btn btn-default'><span class='glyphicon glyphicon-heart' id='red'></span> liked</button>");
                    }, "json");
                // return false;
            })
        });
    </script>
    <style type="text/css">
        html { height: 100% }
        body { height: 100%; margin: 0; padding: 0 }
        textarea {
            border-radius: 5px;
            margin-right: 10px;
        }
        #commentz {
            padding: 0;
        }
        #comments {
            padding-right: 20px;
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
        #red {
            color: red;
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
        <?php
            flash();
        ?>
        <div class='row'>
            <div class='col-md-7' id='pic'>
                <?php
                    $id = $_GET['id'];
                    $secret = $_GET['secret'];
                    echo '<img src="http://www.flickr.com/photos/'.$id.'_'.$secret.'.jpg">';
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
                            echo "<script>var photosNearby = JSON.parse('".addslashes(json_encode($nearby['photos']['photo']))."');</script>";
                            foreach($nearby['photos']['photo'] as $photo) {
                                if ($photo['id'] != $id) {
                                    echo '<div class="item"><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '&secret=' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a></div>';
                                // <a class="title" href="detail.php?id=' . $photo['id'] . '_' . $photo['secret'] . '">'.$photo['title'].'</a>
                                }
                                else
                                {
                                    // var_dump($photo);
                                    // $title = $photo['title'];
                                    // echo "<script>var photo = JSON.parse('".addslashes(json_encode($photo))."');</script>";
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
                    $pics = new Picture();
                    $images = $pics->getPicInfo($id);
                    // var_dump($images);
                    echo "<script>var photo = JSON.parse('".addslashes(json_encode($images['photo']))."');</script>";

                    if($images === false) {
                        echo 'Flickr Feed Unavailable';
                    }
                    else {
                        echo '<h3>Title: '.$images['photo']['title']["_content"].'</h3>';
                    }
                ?>

                <div id='location_heigth'>
                    <div id='location'></div>
                </div>
                <br>

                <div>
                    <div class="collapse navbar-collapse" id="commentz">
                        <ul class="nav navbar-nav col-md-12">
                            <li id='comments'><h4>Comment</h4></li>
                            <li><form action='ajax_like.php' method='post' id='like_button'><input type='hidden' name='action' value='like_button'><input type='hidden' name='user_id' value='<?php echo $_SESSION['id']?>'><input type='hidden' name='pic_id' value='<?php echo $id ?>'> <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-heart"></span> like</button></form></li>
                        </ul>
                    </div>
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
                    $comments = $get_comments->getComments($id);
                    // var_dump($comments);
                    commentsTable($comments);

                    ?>


                    <form action="ajax_comment.php" method="post" id='comment'>
                        <input type='hidden' name='pic_id' value='<?php echo $id ?>'>
                        <!-- <input type='hidden' name='pic_secret' value='<?php echo $secret ?>'> -->
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