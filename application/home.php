<?php
session_start();
include_once("../system/Database.php");
require('header.php');
require_once('../system/Picture.php');
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
  <div id='container' class="row">
    <div class="item" >
      <a href="detail.php?lat=52.522289&lon=13.397923&id=3534028659&secret=ca43d3f8d0">
        <img src="http://farm4.staticflickr.com/3082/3534028659_ca43d3f8d0_m.jpg" />
      </a>
      <h4>Streetart</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=52.524231&lon=13.402097&id=3686111708&secret=a21fbd597d">
        <img src="http://farm3.staticflickr.com/2588/3686111708_a21fbd597d_m.jpg" />
      </a>
      <h4>graffiti</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=52.522837&lon=13.409258&id=2644956705&secret=fdc733a479">
        <img src="http://farm4.staticflickr.com/3275/2644956705_fdc733a479_m.jpg" />
      </a>
      <h4>xoooox - Berlin</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=51.513676&lon=-0.139346&id=263312718&secret=725485ef9f">
        <img src="http://farm1.staticflickr.com/88/263312718_725485ef9f_m.jpg" />
      </a>
      <h4>Carnaby Sticker</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=37.766166&lon=-122.429&id=3043354298&secret=a90326d21b">
        <img src="http://farm4.staticflickr.com/3139/3043354298_a90326d21b_m.jpg" />
      </a>
      <h4>Fire-breathing Bird</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=37.76471&lon=-122.433078&id=5802352223&secret=cfdbd0c89b">
        <img src="http://farm6.staticflickr.com/5117/5802352223_cfdbd0c89b_m.jpg" />
      </a>
      <h4>no title</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=37.767833&lon=-122.429&id=4246396439&secret=57744a9216">
        <img src="http://farm5.staticflickr.com/4012/4246396439_57744a9216_m.jpg" />
      </a>
      <h4>Hi! Word?</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=37.766711&lon=-122.432182&id=1890164822&secret=2c93ffacd5">
        <img src="http://farm3.staticflickr.com/2224/1890164822_2c93ffacd5_m.jpg" />
      </a>
      <h4>5523 miles from here</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=37.760973&lon=-122.435229&id=258320532&secret=4477d9f925">
        <img src="http://farm1.staticflickr.com/79/258320532_4477d9f925_m.jpg" />
      </a>
      <h4>Girafa Angry</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=51.514351&lon=-0.134099&id=296176082&secret=9e2c9121f9">
        <img src="http://farm1.staticflickr.com/112/296176082_9e2c9121f9_m.jpg" />
      </a>
      <h4>Urban Art</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=37.764&lon=-122.433333&id=4695101828&secret=c7228c3a18">
        <img src="http://farm5.staticflickr.com/4071/4695101828_c7228c3a18_m.jpg" />
      </a>
      <h4>no title</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=52.523307&lon=13.404232&id=2050539927&secret=4297ffe315">
        <img src="http://farm3.staticflickr.com/2032/2050539927_4297ffe315_m.jpg" />
      </a>
      <h4>graffiti_0710_004</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=48.841424&lon=2.349559&id=1303845467&secret=da26f4aa83">
        <img src="http://farm2.staticflickr.com/1007/1303845467_da26f4aa83_m.jpg" />
      </a>
      <h4>since 1974.</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=-37.804348&lon=144.949677&id=8756219931&secret=43348f8ba5">
        <img src="http://farm4.staticflickr.com/3686/8756219931_43348f8ba5_m.jpg" />
      </a>
      <h4>Street Art In Melbourne 61</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=52.524371&lon=13.401807&id=2343586131&secret=2fcf55a0d2">
        <img src="http://farm4.staticflickr.com/3280/2343586131_2fcf55a0d2_m.jpg" />
      </a>
      <h4>Miss Van & Miss Lucy</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=51.506663&lon=-0.116812&id=7334209100&secret=afa17ae1e8">
        <img src="http://farm9.staticflickr.com/8006/7334209100_afa17ae1e8_m.jpg" />
      </a>
      <h4>What Do You Think?</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=-37.810764&lon=144.945386&id=8647072662&secret=6224ea0510">
        <img src="http://farm9.staticflickr.com/8240/8647072662_6224ea0510_m.jpg" />
      </a>
      <h4>Fintan Magee West Melbourne </h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=52.523728&lon=13.401281&id=2872712201&secret=2c882994c3">
        <img src="http://farm4.staticflickr.com/3222/2872712201_2c882994c3_m.jpg" />
      </a>
      <h4>Mitte</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=52.524087&lon=13.402419&id=236925851&secret=be4f331fa0">
        <img src="http://farm1.staticflickr.com/88/236925851_be4f331fa0_m.jpg" />
      </a>
      <h4>b003</h4>
    </div>
    <div class="item" >
      <a href="detail.php?lat=52.523454&lon=13.404951&id=2051323460&secret=1c52b14102">
        <img src="http://farm3.staticflickr.com/2288/2051323460_1c52b14102_m.jpg" />
      </a>
      <h4>graffiti_0710_003</h4>
    </div>
  </div>
<script type="text/javascript">
  $(window).load(function() {
    var container = document.querySelector('#container');
    var msnry = new Masonry( container, {
      itemSelector: '.item'
    });
  });
</script>
</div>
<?php require('footer.php'); ?>
