<?php
	session_start();
	// include("Database.php");
    require('header.php');
    require_once('ajax_comment.php');
    require_once('ajax_like.php');
    require_once('Picture.php');

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
                    $('#like_location').html("<input type='hidden' name='like_location' value='"+results[3].formatted_address+"'>");
                    $('#location').html((results[0].formatted_address).split(',').join('<br>'));

                }
              } else {
                alert("Geocoder failed due to: " + status);
              }
            });
          }

        $(document).ready(function(){

            $(document).on("mouseenter", ".item_sm", function(){
                var heart_sm = $(this).find(".check_heart_button");
                // alert($(heart_sm).serialize());
                var little_heart = $(this).find("span")
                $(this).find("h4").css("color", "white");
                $.post(
                    $(heart_sm).attr('action'), $(heart_sm).serialize(), function(param) {
                        // alert(param);
                        if (param[0] == "liked") {
                            // $('.heart_span').html("<span class='glyphicon glyphicon-heart red_heart'></span>");
                            $(little_heart).css("color", "red");
                        } else {
                            $(little_heart).css("color", "white");
                        };
                    }, "json");
                return false;
            });

            $(document).on("mouseleave", ".item_sm", function(){
                $(this).find("h4").css("color", "transparent");
                $(this).find("span").css("color", "transparent");
            });

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
                // alert($("#like_button").serialize());
                $.post(
                    $(this).attr('action'), $(this).serialize(), function(param) {

                        if (param[0] == "like successful") {
                            $('#like_btn').html("<span class='glyphicon glyphicon-heart' id='red'></span> liked");
                        }
                        else {
                            // alert(param);
                            $('#like_btn').html("<span class='glyphicon glyphicon-heart'></span> like");
                        }
                        if (param[1] == 1) {
                            $('#likes_count').html("<p><span class='badge'>"+param[1]+"</span> like</p>");
                        } else {
                            $('#likes_count').html("<p><span class='badge'>"+param[1]+"</span> likes</p>");
                        };
                    }, "json");
                return false;
            })

            $(document).on("click", '.heart_btn', function() {
                var heart = $(this);
                // alert($("#like_button").serialize());
                $.post(
                    $(this).attr('action'), $(this).serialize(), function(param) {
                        // console.log(heart);
                        if (param[0] == "like successful") {
                            $(heart).find(".heart_span").html("<span class='glyphicon glyphicon-heart' id='red'></span>");
                        }
                        else {
                            // alert(param);
                            $(heart).find(".heart_span").html("<span class='glyphicon glyphicon-heart'></span>");
                        }
                    }, "json");
                return false;
            })

            $(document).ready(function() {
                // alert($("#check_like_button").serialize());
                $.post(
                    $('#check_like_button').attr('action'), $('#check_like_button').serialize(), function(param) {
                        // alert(param);
                        if (param[0] == "liked") {
                            $('#like_btn').html("<span class='glyphicon glyphicon-heart' id='red'></span> liked");
                        };
                        if (param[1] == 1) {
                            $('#likes_count').html("<p><span class='badge'>"+param[1]+"</span> like</p>");
                        } else {
                            $('#likes_count').html("<p><span class='badge'>"+param[1]+"</span> likes</p>");
                        };
                    }, "json");
                return false;
            });
        });
    </script>

    <div class="container" id='my_container'>
        <?php
            flash();
        ?>
        <div class='row'>
            <div class='col-md-7' id='pic'>
                <?php
                    $id = $_GET['id'];
                    $secret = $_GET['secret'];
                    $lat = $_GET['lat'];
                    $lon = $_GET['lon'];
                    echo '<img src="http://www.flickr.com/photos/'.$id.'_'.$secret.'.jpg">';
                ?>
                <h4>Street Art nearby:</h4>
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
                                    if (isset($_SESSION['logged_in'])){
                                    echo '<div class="item_sm"><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '&secret=' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a>
                                        <h4>'.$photo['title'].'</h4>
                                        <form action="ajax_like.php" method="post" class="heart_btn">
                                        <input type="hidden" name="action" value="like_button">
                                        <input type="hidden" name="user_id" value='.$_SESSION['id'].'>
                                        <input type="hidden" name="pic_id" value='.$photo['id'].'>
                                        <input type="hidden" name="pic_secret" value='.$photo['secret'].'>
                                        <input type="hidden" name="lon" value='. $photo['longitude'] .'>
                                        <input type="hidden" name="lat" value='. $photo['latitude'] .'>
                                        <input type="hidden" name="name" value='. $photo['title'] .'>
                                        <input type="hidden" name="like_location" value="undefined">
                                        <button class="heart_span"><span class="glyphicon glyphicon-heart"></span></button></form>
                                        <form action="ajax_like.php" method="post" class="check_heart_button">
                                        <input type="hidden" name="action" value="check_like_button">
                                        <input type="hidden" name="user_id" value='.$_SESSION['id'].'>
                                        <input type="hidden" name="pic_id" value='.$photo['id'].'></form></div>';
                                    } else {
                                        echo '<div class="item_sm"><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '&secret=' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a>
                                            <h4>'.$photo['title'].'</h4></div>';
                                    }

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
                            <li id="likes_count"></li>
                            <?php if (isset($_SESSION['logged_in'])): ?>
                            <li><form action='ajax_like.php' method='post' id='like_button'>
                                <input type='hidden' name='action' value='like_button'>
                                <input type='hidden' name='user_id' value='<?php echo $_SESSION['id']?>'>
                                <input type='hidden' name='pic_id' value='<?php echo $id ?>'>
                                <input type='hidden' name='pic_secret' value='<?php echo $secret ?>'>
                                <input type='hidden' name='lon' value='<?php echo $lon ?>'>
                                <input type='hidden' name='lat' value='<?php echo $lat ?>'>
                                <input type='hidden' name='name' value='<?php echo $images['photo']['title']["_content"] ?>'>
                                <div id='like_location'></div>
                                <button type="button" class="btn btn-default" id='like_btn'>
                                    <span class="glyphicon glyphicon-heart"></span> like</button></form></li>

                                <?php endif; ?>

                            <li><form action='ajax_like.php' method='post' id='check_like_button'><input type='hidden' name='action' value='check_like_button'><input type='hidden' name='user_id' value='<?php echo $_SESSION['id']?>'><input type='hidden' name='pic_id' value='<?php echo $id ?>'></form></li>

                        </ul>
                    </div>
                    <hr>
                    <?php
                    function commentsTable($comments)
                    {
                        $html = "";
                        foreach($comments as $comment)
                        {
                            $html .= "<p><strong class='user'>".$comment['user']."</strong>";
                            $html .= " ".$comment['comment']."</p>";
                        }
                        $html .= "</tbody></table>";
                        echo $html;
                    }
                    $get_comments = new Comment();
                    $comments = $get_comments->getComments($id);
                    // var_dump($comments);
                    commentsTable($comments);
                    echo "<p id='commentsTable'></p>";
                    ?>

                    <hr>
                    <form action="ajax_comment.php" method="post" id='comment'>
                        <input type='hidden' name='pic_id' value='<?php echo $id ?>'>
                        <input type='hidden' name='action' value='comment' >
                        <?php
                            if (isset($_SESSION['logged_in'])) {
                                echo "<input type='hidden' name='user_id' value=". $_SESSION['id'] .">";
                                echo "<textarea rows='4' cols='50' name='comment'></textarea>";
                                echo "<input type='submit' value='Say It' class='btn btn-primary'>";
                            }
                            elseif (!isset($_SESSION['logged_in']) && empty($comments)) {
                                echo '<a href="login.php">Log in</a> and be the first to comment';
                            }
                            elseif (isset($_SESSION['logged_in']) && empty($comments)) {
                                echo 'Be the first to comment';
                            }
                            elseif (!isset($_SESSION['logged_in']) && !empty($comments))
                            {
                                echo '<a href="login.php">Log in</a> to comment';
                            };
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
              itemSelector: '.item_sm'
            });
        });

    </script>

<?php require('footer.php'); ?>