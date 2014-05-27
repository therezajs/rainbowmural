<?php
  session_start();
  require("header.php");
  require_once("../system/Database.php");
  require('../system/Favorite.php');
?>

<script type="text/javascript" src="../assets/js/likes.js"></script>

<div class='container' id="my_container">
  <?php
    flash();
  ?>
  <h2>Likes</h2>
  <div class='row' id='pic_container'>
  <?php
    if (isset($_SESSION['id'])):
      $data = new Favorite();
      $likes = $data->getLikes($_SESSION['id']);
      if (!empty($likes)):
        foreach ($likes as $like):
          $lat = $like['lat'];
          $lon = $like['lon'];
          $id = $like['pic_id'];
          $secret = $like['pic_secret'];
          $title = $like['title'];
        ?>
        <div class="item" >
          <a href="detail.php?lat=<?php echo $lat ?>&lon=<?php echo $lon ?>&id=<?php echo $id ?>&secret=<?php echo $secret ?>">
            <img src="http://www.flickr.com/photos/<?php echo $id ?>_<?php echo $secret ?>.jpg">
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
      <h3> No likes set yet</h3>
    <?php endif; ?>
  <?php else: ?>
    <h3>Please log in to see your likes</h3>
  <?php endif; ?>
  </div>

  <script type="text/javascript" src="../assets/js/masonry.js"></script>

</div>
<?php require('footer.php'); ?>
