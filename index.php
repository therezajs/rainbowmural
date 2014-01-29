<?php
session_start();
include("Database.php");
require('header.php');
require_once('Picture.php');
?>
<script type="text/javascript">
$(document).ready(function(){
  $(document).on("mouseenter", ".item", function(){
      $(this).find("h4").css("color", "white");
      $(this).find("span").css("color", "white");
    });

  $(document).on("mouseleave", ".item", function(){
    $("h4").css("color", "transparent");
    $(this).find("span").css("color", "transparent");
  });
});
</script>

<div class='container' id='my_container'>
  <div id='messages'>
  <?php
    flash();
  ?>

  </div>
  <div class="row">

    <!-- <div class='col-md-4' id="search">
      <form action='Picture.php' method='post'>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Choose your city" name="name">
          <span class="input-group-btn">
            <button class="btn btn-success" type="button">Go!</button>
          </span>
          <input type='hidden' name='action' value='city'>
        </div>
      </form>
    </div> -->
    <div class='col-md-4'></div>
  </div>
  <p>Suggested cities:</p>
  <div class="collapse navbar-collapse">
  <ul class="nav navbar-nav col-md-12">
    <li class='col-md-3'>
      <a class="btn btn-success" id="frisco" href="map.php?lat=37.779&lon=-122.420&place=San%20Francisco">San Francisco</a>
    </li>
    <li class='col-md-3'>
      <a class="btn btn-success" id="paris" href="map.php?lat=48.856&lon=2.341&place=Paris">Paris</a>
    </li>
    <li class='col-md-3'>
      <a class="btn btn-success" id="london" href="map.php?lat=51.506&lon=-0.127&place=London">London</a>
    </li>
    <li class='col-md-3'>
      <a class="btn btn-success" id="berlin" href="map.php?lat=52.516&lon=13.376&place=Berlin">Berlin</a>
    </li>
  </ul>
  </div>
  <div id='container' class="row">

  <?php

  // $pics = new Picture();
  // $images = $pics->getRandomPics('30', '1');
  // // var_dump($images);
  // if($images === false) {
  //     echo 'Flickr Feed Unavailable';
  // }
  // else {
  //     foreach($images['photos']['photo'] as $photo) {
  //         echo '<div class="item" ><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '&secret=' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a></div>';
  //         // echo '<a href="http://flickr.com/photos/' . $photo->attributes()->owner . '/' . $photo->attributes()->id . '"><img src="http://farm' . $photo->attributes()->farm . '.static.flickr.com/' . $photo->attributes()->server . '/' . $photo->attributes()->id . '_' . $photo->attributes()->secret . '_s.jpg" /></a>';
  //     }
  // }
  ?>
  <div class="item" ><a href="detail.php?lat=52.522289&lon=13.397923&id=3534028659&secret=ca43d3f8d0"><img src="http://farm4.staticflickr.com/3082/3534028659_ca43d3f8d0_m.jpg" /></a><h4>Streetart</h4></div>

  <div class="item" ><a href="detail.php?lat=52.524231&lon=13.402097&id=3686111708&secret=a21fbd597d"><img src="http://farm3.staticflickr.com/2588/3686111708_a21fbd597d_m.jpg" /></a><h4>graffiti</h4></div>

  <div class="item" ><a href="detail.php?lat=52.522837&lon=13.409258&id=2644956705&secret=fdc733a479"><img src="http://farm4.staticflickr.com/3275/2644956705_fdc733a479_m.jpg" /></a><h4>xoooox - Berlin</h4></div>

  <div class="item" ><a href="detail.php?lat=51.513676&lon=-0.139346&id=263312718&secret=725485ef9f"><img src="http://farm1.staticflickr.com/88/263312718_725485ef9f_m.jpg" /></a><h4>Carnaby Sticker</h4></div>

  <div class="item" ><a href="detail.php?lat=37.766166&lon=-122.429&id=3043354298&secret=a90326d21b"><img src="http://farm4.staticflickr.com/3139/3043354298_a90326d21b_m.jpg" /></a><h4>Fire-breathing Bird</h4></div>

  <div class="item" ><a href="detail.php?lat=37.76471&lon=-122.433078&id=5802352223&secret=cfdbd0c89b"><img src="http://farm6.staticflickr.com/5117/5802352223_cfdbd0c89b_m.jpg" /></a><h4>no title</h4></div>

  <div class="item" ><a href="detail.php?lat=37.767833&lon=-122.429&id=4246396439&secret=57744a9216"><img src="http://farm5.staticflickr.com/4012/4246396439_57744a9216_m.jpg" /></a><h4>Hi! Word?</h4></div>

  <div class="item" ><a href="detail.php?lat=37.766711&lon=-122.432182&id=1890164822&secret=2c93ffacd5"><img src="http://farm3.staticflickr.com/2224/1890164822_2c93ffacd5_m.jpg" /></a><h4>5523 miles from here</h4></div>

  <div class="item" ><a href="detail.php?lat=37.760973&lon=-122.435229&id=258320532&secret=4477d9f925"><img src="http://farm1.staticflickr.com/79/258320532_4477d9f925_m.jpg" /></a><h4>Girafa Angry</h4></div>

  <div class="item" ><a href="detail.php?lat=51.514351&lon=-0.134099&id=296176082&secret=9e2c9121f9"><img src="http://farm1.staticflickr.com/112/296176082_9e2c9121f9_m.jpg" /></a><h4>Urban Art</h4></div>

  <div class="item" ><a href="detail.php?lat=37.764&lon=-122.433333&id=4695101828&secret=c7228c3a18"><img src="http://farm5.staticflickr.com/4071/4695101828_c7228c3a18_m.jpg" /></a><h4>no title</h4></div>

  <div class="item" ><a href="detail.php?lat=52.523307&lon=13.404232&id=2050539927&secret=4297ffe315"><img src="http://farm3.staticflickr.com/2032/2050539927_4297ffe315_m.jpg" /></a><h4>graffiti_0710_004</h4></div>

  <div class="item" ><a href="detail.php?lat=48.841424&lon=2.349559&id=1303845467&secret=da26f4aa83"><img src="http://farm2.staticflickr.com/1007/1303845467_da26f4aa83_m.jpg" /></a><h4>since 1974.</h4></div>

  <div class="item" ><a href="detail.php?lat=-37.804348&lon=144.949677&id=8756219931&secret=43348f8ba5"><img src="http://farm4.staticflickr.com/3686/8756219931_43348f8ba5_m.jpg" /></a><h4>Street Art In Melbourne 61</h4></div>

  <div class="item" ><a href="detail.php?lat=52.524371&lon=13.401807&id=2343586131&secret=2fcf55a0d2"><img src="http://farm4.staticflickr.com/3280/2343586131_2fcf55a0d2_m.jpg" /></a><h4>Miss Van & Miss Lucy</h4></div>

  <div class="item" ><a href="detail.php?lat=51.506663&lon=-0.116812&id=7334209100&secret=afa17ae1e8"><img src="http://farm9.staticflickr.com/8006/7334209100_afa17ae1e8_m.jpg" /></a><h4>What Do You Think?</h4></div>

  <div class="item" ><a href="detail.php?lat=-37.810764&lon=144.945386&id=8647072662&secret=6224ea0510"><img src="http://farm9.staticflickr.com/8240/8647072662_6224ea0510_m.jpg" /></a><h4>Fintan Magee West Melbourne </h4></div>

  <div class="item" ><a href="detail.php?lat=52.523728&lon=13.401281&id=2872712201&secret=2c882994c3"><img src="http://farm4.staticflickr.com/3222/2872712201_2c882994c3_m.jpg" /></a><h4>Mitte</h4></div>

  <div class="item" ><a href="detail.php?lat=52.524087&lon=13.402419&id=236925851&secret=be4f331fa0"><img src="http://farm1.staticflickr.com/88/236925851_be4f331fa0_m.jpg" /></a><h4>b003</h4></div>

  <div class="item" ><a href="detail.php?lat=52.523454&lon=13.404951&id=2051323460&secret=1c52b14102"><img src="http://farm3.staticflickr.com/2288/2051323460_1c52b14102_m.jpg" /></a><h4>graffiti_0710_003</h4></div>

  </div>
  <script type="text/javascript">
    $(window).load(function() {
      var container = document.querySelector('#container');
      var msnry = new Masonry( container, {
        itemSelector: '.item'
      });
      $(window).scroll(function() {
        if (  document.documentElement.clientHeight +
            $(document).scrollTop() >= document.body.offsetHeight )
        {

          // $page = 1;
          // $more_images = $pics->getRandomPics('30', '2');
          // var_dump($more_images);
          // if($more_images === false) {
          //     echo 'Flickr Feed Unavailable';
          // }
          // else {
          //     foreach($more_images['photos']['photo'] as $photo) {
          //         echo '<div class="item" ><a href="detail.php?lat=' . $photo['latitude'] . '&lon=' . $photo['longitude'] . '&id=' . $photo['id'] . '&secret=' . $photo['secret'] . '"><img src="http://farm' . $photo['farm'] . '.static.flickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '_m.jpg" /></a></div>';
          //     }
          // }

        };
      });
    });
  </script>
</div>
<?php require('footer.php'); ?>
