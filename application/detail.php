<?php
  session_start();
  require('header.php');
  require_once('ajax_comment.php');
  require_once('ajax_like.php');
  require_once('ajax_picture.php');
?>
<script type="text/javascript" src="../assets/js/mapMarkersGeocoder.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on("submit", '#comment', function() {
      var form = $(this);
      $.post(
        $(this).attr('action'), $(this).serialize(), function(param) {
          if (param == "comment successful") {
            $('#commentsTable').append("<strong><?php echo $_SESSION['user_name'] ?></strong> " + $('#written_comment').val());
          };
          $(form).each(function(){
              this.reset();
          })
        }, "json");
      return false;
    });
  });
</script>
<script type="text/javascript" src="../assets/js/changeSmallHeartColor.js"></script>
<script type="text/javascript" src="../assets/js/comment.js"></script>
<div class="container" id='my_container'>
  <?php
    flash();
  ?>
  <div class='row'>
    <div class='col-md-7 col-xs-12' id='pic'>
      <?php
        $detail_id = $_GET['id'];
        $detail_secret = $_GET['secret'];
        $detail_lat = $_GET['lat'];
        $detail_lon = $_GET['lon'];
      ?>
      <img src="http://www.flickr.com/photos/<?php echo $detail_id ?>_<?php echo $detail_secret?>.jpg">
      <h4>Street Art nearby:</h4>
      <div class='row' id='nearby_container'>
        <?php if (isset($_GET['lat'])): ?>
          <?php $pics = new Picture();
          $nearby = $pics->getPicsNearby($detail_lat, $detail_lon); ?>
          <?php if($nearby === false): ?>
            <h5>Flickr Feed Unavailable</h5>
          <?php else: ?>
            <script>var photosNearby = JSON.parse('<?php echo addslashes(json_encode($nearby['photos']['photo'])) ?>');</script>
            <?php foreach($nearby['photos']['photo'] as $photo): ?>
              <?php if ($photo['id'] != $detail_id): ?>
                <?php
                  $lat = $photo['latitude'];
                  $lon = $photo['longitude'];
                  $id = $photo['id'];
                  $secret = $photo['secret'];
                  $farm = $photo['farm'];
                  $server = $photo['server'];
                  $title = $photo['title'];
                ?>
                <?php if (isset($_SESSION['logged_in'])): ?>
                  <div class="item_sm">
                    <a href="detail.php?lat=<?php echo $lat ?>&lon=<?php echo $lon ?>&id=<?php echo $id ?>&secret=<?php echo $secret ?>">
                      <img src="http://farm<?php echo $farm ?>.static.flickr.com/<?php echo $server ?>/<?php echo $id ?>_<?php echo $secret ?>_m.jpg" />
                    </a>
                    <h4><?php echo $title ?></h4>
                    <form action="ajax_like.php" method="post" class="heart_btn">
                      <input type="hidden" name="action" value="like_button">
                      <input type="hidden" name="user_id" value='<?php echo $_SESSION['id'] ?>' >
                      <input type="hidden" name="pic_id" value='<?php echo $id ?>' >
                      <input type="hidden" name="pic_secret" value='<?php echo $secret ?>' >
                      <input type="hidden" name="lon" value='<?php echo $lon ?>' >
                      <input type="hidden" name="lat" value='<?php echo $lat ?>' >
                      <input type="hidden" name="name" value='<?php echo $title ?>' >
                      <input type="hidden" name="like_location" value="undefined">
                      <button class="heart_span">
                        <span class="glyphicon glyphicon-heart"></span>
                      </button>
                    </form>
                    <form action="ajax_like.php" method="post" class="check_heart_button">
                      <input type="hidden" name="action" value="check_like_button">
                      <input type="hidden" name="user_id" value='<?php echo $_SESSION['id'] ?>' >
                      <input type="hidden" name="pic_id" value='<?php echo $id ?>' >
                    </form>
                  </div>
                <?php else: ?>
                  <div class="item_sm">
                    <a href="detail.php?lat=<?php echo $lat ?>&lon=<?php echo $lon ?>&id=<?php echo $id ?>&secret=<?php echo $secret ?>">
                    <img src="http://farm<?php echo $farm ?>.static.flickr.com/<?php echo $server ?>/<?php echo $id ?>_<?php echo $secret ?>_m.jpg" />
                    </a>
                    <h4><?php echo $title ?></h4>
                  </div>
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; ?>
            <script>var photos = JSON.parse('<?php echo addslashes(json_encode($nearby['photos']['photo'])) ?>');</script>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
    <div class='col-md-5 col-xs-12 initial_height'>
      <div id='map'>
        <div id="map-canvas"></div>
      </div>
      <br>
      <?php
        $pics = new Picture();
        $images = $pics->getPicInfo($id);
      ?>
        <script>var photo = JSON.parse('<?php echo addslashes(json_encode($images['photo'])) ?>');</script>
      <?php if($images === false): ?>
          <p>Flickr Feed Unavailable</p>
      <?php else:
        $detail_title = $images['photo']['title']["_content"]
      ?>
          <h3>Title: <?php echo $detail_title ?></h3>
      <?php endif; ?>
      <div id='location_heigth'>
        <div id='location'></div>
      </div>
      <br>
      <div>
        <div class="collapse navbar-collapse" id="commentz">
          <ul class="nav navbar-nav col-md-12">
            <li id='comments'>
              <h4>Comment</h4>
            </li>
            <li id="likes_count"></li>
            <?php if (isset($_SESSION['logged_in'])): ?>
            <li>
              <form action='ajax_like.php' method='post' id='like_button'>
                <input type='hidden' name='action' value='like_button'>
                <input type='hidden' name='user_id' value='<?php echo $_SESSION['id']?>'>
                <input type='hidden' name='pic_id' value='<?php echo $detail_id ?>'>
                <input type='hidden' name='pic_secret' value='<?php echo $detail_secret ?>'>
                <input type='hidden' name='lon' value='<?php echo $detail_lon ?>'>
                <input type='hidden' name='lat' value='<?php echo $detail_lat ?>'>
                <input type='hidden' name='name' value='<?php echo $detail_title ?>'>
                <div id='like_location'></div>
                <button type="button" class="btn btn-default" id='like_btn'>
                  <span class="glyphicon glyphicon-heart"></span> like</button>
              </form>
            </li>
            <?php endif; ?>
            <li>
              <form action='ajax_like.php' method='post' id='check_like_button'>
                <input type='hidden' name='action' value='check_like_button'>
                <input type='hidden' name='user_id' value='<?php echo $_SESSION['id']?>'>
                <input type='hidden' name='pic_id' value='<?php echo $detail_id ?>'>
              </form>
            </li>
          </ul>
        </div>
        <hr>
        <?php
          $get_comments = new Comment();
          $comments = $get_comments->getComments($detail_id);
        ?>
        <table><tbody>
        <?php foreach($comments as $comment): ?>
          <p><strong class='user'><?php echo $comment['user'] ?></strong> <?php echo $comment['comment'] ?></p>
        <?php endforeach ?>
        </tbody></table>
        <p id='commentsTable'></p>
        <hr>
        <form action="ajax_comment.php" method="post" id='comment'>
          <input type='hidden' name='pic_id' value='<?php echo $detail_id ?>'>
          <input type='hidden' name='action' value='comment' >
          <?php if (isset($_SESSION['logged_in'])): ?>
              <input type='hidden' name='user_id' value="<?php echo $_SESSION['id'] ?>">
              <textarea rows='4' cols='50' name='comment' id='written_comment'></textarea>
              <input type='submit' value='Say It' class='btn btn-primary'>
          <?php elseif (!isset($_SESSION['logged_in']) && empty($comments)): ?>
              <p><a href="login.php">Log in</a> and be the first to comment</p>
          <?php elseif (isset($_SESSION['logged_in']) && empty($comments)): ?>
              <p>Be the first to comment</p>
          <?php elseif (!isset($_SESSION['logged_in']) && !empty($comments)): ?>
              <p><a href="login.php">Log in</a> to comment</p>
          <?php endif; ?>
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
