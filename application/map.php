<?php
  session_start();
  include_once("../system/Database.php");
  require_once('ajax_picture.php');
  require('header.php');
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

<div class="container" id='my_container'>
  <?php
    flash();
  ?>
  <div class="row">
    <div class='col-md-8 col-xs-8' id='pic_container'>
      <?php if (isset($_GET['lat'])):
      $pics = new Picture();
      $images = $pics->getCityPics($_GET['lat'], $_GET['lon'], '1'); ?>
        <?php if($images === false): ?>
          <p>Flickr Feed Unavailable</p>
        <?php elseif ($images['photos']['total'] == NULL): ?>
          <div class='col-md-12'><h3>Where are you flickr? Flickr API is so down!!</h3></div>
        <?php else: ?>
          <?php if (isset($_SESSION['logged_in'])): ?>
            <?php foreach($images['photos']['photo'] as $photo):
              $lat = $photo['latitude'];
              $lon = $photo['longitude'];
              $id = $photo['id'];
              $secret = $photo['secret'];
              $title = $photo['title'];
              $farm = $photo['farm'];
              $server = $photo['server'];
            ?>
              <div class="item">
                <a href="detail.php?lat=<?php echo $lat ?>&lon=<?php echo $lon ?>&id=<?php echo $id ?>&secret=<?php echo $secret ?>" >
                  <img src="http://farm<?php echo $farm ?>.static.flickr.com/<?php echo $server ?>/<?php echo $id ?>_<?php echo $secret ?>_m.jpg" />
                </a>
                <h4><?php echo $title ?></h4>
                <form action="ajax_like.php" method="post" class="heart_btn">
                  <input type="hidden" name="action" value="like_button">
                  <input type="hidden" name="user_id" value='<?php echo $_SESSION['id'] ?>'>
                  <input type="hidden" name="pic_id" value='<?php echo $id ?>'>
                  <input type="hidden" name="pic_secret" value='<?php echo $secret ?>'>
                  <input type="hidden" name="lon" value='<?php echo $lon ?>'>
                  <input type="hidden" name="lat" value='<?php echo $lat ?>'>
                  <input type="hidden" name="name" value='<?php echo $title ?>'>
                  <input type="hidden" name="like_location" value="undefined">
                  <button class="heart_span">
                    <span class="glyphicon glyphicon-heart"></span>
                  </button>
                </form>
                <form action="ajax_like.php" method="post" class="check_heart_button">
                  <input type="hidden" name="action" value="check_like_button">
                  <input type="hidden" name="user_id" value='<?php echo $_SESSION['id'] ?>'>
                  <input type="hidden" name="pic_id" value='<?php echo $id ?>'>
                </form>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <?php foreach($images['photos']['photo'] as $photo):
              $lat = $photo['latitude'];
              $lon = $photo['longitude'];
              $id = $photo['id'];
              $secret = $photo['secret'];
              $title = $photo['title'];
              $farm = $photo['farm'];
              $server = $photo['server'];
            ?>
              <div class="item">
                <a href="detail.php?lat=<?php echo $lat ?>&lon=<?php echo $lon ?>&id=<?php echo $id ?>&secret=<?php echo $secret ?>" >
                  <img src="http://farm<?php echo $farm ?>.static.flickr.com/<?php echo $server ?>/<?php echo $id ?>_<?php echo $secret ?>_m.jpg" />
                </a>
                <h4><?php echo $title ?></h4>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
          <script>var photos = JSON.parse('<?php echo addslashes(json_encode($images['photos']['photo'])) ?>');</script>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class='col-md-4 col-xs-4' id='my_map'>
      <h2>
        <?php if (isset($_GET['place'])): ?>
          <?php $_GET['place']; ?>
        <?php else: ?>
          <p>Choose your city</p>
        <?php endif; ?>
      </h2>
      <div id="map">
        <div id="map-canvas"/>
      </div>
      <div>
        <hr>
        <footer>
          <p>Made with love by
            <a href="about.php">Thereza</a>, 2013 |
            <a href="http://www.linkedin.com/in/thereza">LinkedIn</a> |
            <a href="https://twitter.com/therezaJS">Twitter</a> |
            <a href="https://github.com/bakerstreet221b">Github</a>
          </p>
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
  });
</script>
</body>
</html>