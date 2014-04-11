<?php
  session_start();
  include("../system/Database.php");
  require('header.php');
  require_once('../system/Picture.php');
?>
  <script type="text/javascript">
    function initialize() {

    var mapOptions = {
      center: new google.maps.LatLng("<?php echo $_GET['lat']?>","<?php echo $_GET['lon']?>"),
      zoom: 12,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"),
      mapOptions);
       var current_marker = null;
    photos.forEach(function(each) {
      var ll = new google.maps.LatLng(each.latitude,each.longitude);
      var marker = new google.maps.Marker({
        position: ll,
        map: map,
        title: each.title
      });
      var contentString = '<a href="detail.php?lat=' + each.latitude + '&lon=' + each.longitude + '&id=' + each.id + '&secret=' + each.secret + '"><img class="images" src="http://www.flickr.com/photos/'+each.id+'_'+each.secret+'_s.jpg"></a>';

      var that = this;
      that.infowindow = new google.maps.InfoWindow({
        content: contentString
      });


      google.maps.event.addListener(marker, 'mouseover', function() {
        // console.log(this.__gm_id);
        if(current_marker && this.__gm_id != current_marker.__gm_id)
        {
        // console.log(current_marker.__gm_id);
          // console.log("close");
          that.infowindow.close();
        }
        current_marker = marker;
        that.infowindow.content = contentString;
        that.infowindow.setOptions({ disableAutoPan : true });
        that.infowindow.open(map, current_marker);
      });
      // google.maps.event.addListener(marker, 'mouseout', function() {
      // // infowindow.close();
      // });
    });


    }
    google.maps.event.addDomListener(window, 'load', initialize);

  $(document).ready(function(){
    $(document).on("mouseenter", ".item", function(){
      var heart_sm = $(this).find(".check_heart_button");
      // alert($(heart_sm).serialize());
      var little_heart = $(this).find("span")
      $(this).find("h4").css("color", "white");
      $(this).find("h4").css("text-shadow", "0 0 2px black");
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

    $(document).on("mouseleave", ".item", function(){
      $(this).find("h4").css("color", "transparent");
      $(this).find("h4").css("text-shadow", "0 0 2px transparent");
      $(this).find("span").css("color", "transparent");
    });

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
  });
  </script>
<a href=""></a>
  <div class="container" id='my_container'>
    <?php
      flash();
    ?>
    <div class="row">

      <div class='col-md-8 col-xs-8' id='pic_container'>

<?php

  if (isset($_GET['lat'])) {

    $pics = new Picture();
    $images = $pics->getCityPics($_GET['lat'], $_GET['lon'], '1');
    // var_dump($images);
    if($images === false) {
      echo 'Flickr Feed Unavailable';
    }
    else {
      if (isset($_SESSION['logged_in'])){
        foreach($images['photos']['photo'] as $photo) {
          echo '<div class="item"><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '&secret=' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a><h4>' . $photo['title'] . '</h4><form action="ajax_like.php" method="post" class="heart_btn">
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

        }
      } else {
        foreach($images['photos']['photo'] as $photo) {
          echo '<div class="item"><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '&secret=' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a><h4>' . $photo['title'] . '</h4></div>';
        }
      }

      echo "<script>var photos = JSON.parse('".addslashes(json_encode($images['photos']['photo']))."');</script>";

    }

  }
?>
      </div>
      <!-- <div class='col-md-4' id='cityname'>

      </div> -->
      <div class='col-md-4 col-xs-4' id='my_map'>
        <h2><?php
        if (isset($_GET['place'])) {
          echo $_GET['place'];
        }
        else
        {
          echo "Choose your city";
        } ?></h2>

        <div id="map">
          <div id="map-canvas"/>
        </div>
        <div>
          <hr>
          <footer>
            <p>Made with love by <a href="about.php">Thereza</a>, 2013 | <a href="http://www.linkedin.com/in/thereza">LinkedIn</a> | <a href="https://twitter.com/therezaJS">Twitter</a> | <a href="https://github.com/bakerstreet221b">Github</a></p>

          </footer><br>
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

        $(window).scroll(function () {
           if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
            // alert("Add something at the end of the page");
           }
        });
      });
    </script>
  </body>
</html>