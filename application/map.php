<?php
  session_start();
  include_once("../system/Database.php");
  require_once('ajax_picture.php');
  require('header.php');
?>

<script type="text/javascript" src="../assets/js/googleMapsApi.js"></script>
<script type="text/javascript" src="../assets/js/changeHeartColor.js"></script>

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

<script type="text/javascript" src="../assets/js/masonry.js"></script>

</body>
</html>