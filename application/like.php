<?php
  session_start();
  require("header.php");
  require_once("../system/Database.php");
  require('../system/Fav.php');

?>
<script type="text/javascript">
$(document).ready(function(){
  $(document).on("mouseenter", ".item", function(){
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

  $(document).on("mouseleave", ".item", function(){
    $(this).find("h4").css("color", "transparent");
    $(this).find("span").css("color", "transparent");
  });

  $(document).on("click", '.heart_btn', function() {
    var heart = $(this).parent(".item");
    // alert($("#like_button").serialize());
    $.post(
      $(this).attr('action'), $(this).serialize(), function(param) {
        // console.log(heart);
        if (param[0] == "unlike successful") {
          // alert(param);
          $(heart).fadeOut("slow");
        }
      }, "json");
    return false;
  })
});
</script>
<div class='container' id="my_container">
  <?php
    flash();
  ?>
  <h2>Likes</h2>
  <div class='row' id='like_container'>
  <?php
  if (isset($_SESSION['id']))
  {
    $data = new Fav();
    $likes = $data->getLikes($_SESSION['id']);

    // var_dump($likes);
    if (!empty($likes))
    {
      foreach ($likes as $like) {
        echo '<div class="item" ><a href="detail.php?lat=' . $like['lat'] . '&lon=' . $like['lon'] . '&id=' . $like['pic_id'] . '&secret=' . $like['pic_secret'] . '"><img src="http://www.flickr.com/photos/'.$like['pic_id'].'_'.$like['pic_secret'].'.jpg"></a><h4>'.$like['title'].'</h4><form action="ajax_like.php" method="post" class="heart_btn">
          <input type="hidden" name="action" value="like_button">
          <input type="hidden" name="user_id" value='.$_SESSION['id'].'>
          <input type="hidden" name="pic_id" value='.$like['pic_id'].'>
          <input type="hidden" name="pic_secret" value='.$like['pic_secret'].'>
          <input type="hidden" name="lon" value='. $like['lon'] .'>
          <input type="hidden" name="lat" value='. $like['lat'] .'>
          <input type="hidden" name="name" value='. $like['title'] .'>
          <input type="hidden" name="like_location" value="undefined">
          <button class="heart_span"><span class="glyphicon glyphicon-heart"></span></button></form>
          <form action="ajax_like.php" method="post" class="check_heart_button">
          <input type="hidden" name="action" value="check_like_button">
          <input type="hidden" name="user_id" value='.$_SESSION['id'].'>
          <input type="hidden" name="pic_id" value='.$like['pic_id'].'></form></div>';
      }
    }
    else
    {
      echo "<h3> No likes set yet</h3>";
    };
  }
  else
  {
    echo "<h3>Please log in to see your likes</h3>";
  };

  ?>
  </div>
  <script type="text/javascript">
    $(window).load(function() {
      var container = document.querySelector('#like_container');
      var msnry = new Masonry( container, {
        itemSelector: '.item'
      });

    });
  </script>
</div>
<?php require('footer.php'); ?>
