<?php require('header.php'); ?>
<div id='home_container'>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item bg">
      <img src="https://farm9.staticflickr.com/8482/8224341564_7705fbbc3f_c.jpg" class="img-responsive my_carusel" alt="Responsive image" id="fish">
    </div>
    <div class="item bg">
      <img src="https://farm1.staticflickr.com/70/176582625_ed5d35dc98.jpg" class="img-responsive my_carusel" alt="Responsive image" id="unicorn">
    </div>
    <div class="item bg">
      <img src="https://farm1.staticflickr.com/62/176581933_3d503bbc52.jpg" class="img-responsive my_carusel" alt="Responsive image" id="flowers">
    </div>
    <div class="item bg">
      <img src="scribbles.jpg" class="img-responsive my_carusel" alt="Responsive image" id="Banksy">
    </div>
    <div class="item bg">
      <img src="https://farm3.staticflickr.com/2094/5764044402_a67dc976cb_z.jpg" class="img-responsive my_carusel" alt="Responsive image" id="fox">
    </div>
    <div class="item active bg">
      <img src="https://farm5.staticflickr.com/4128/5029933896_8a8e2afacb.jpg" class="img-responsive my_carusel" alt="Responsive image" id="namaste">
    </div>
    <div class="item bg">
      <img src="https://farm4.staticflickr.com/3510/3879874342_ee7a713898_z.jpg" class="img-responsive my_carusel" alt="Responsive image" id="skull">
    </div>
  </div>

  <div class="container">
    <div class="col-xs-1 col-md-1"></div>
    <div class="col-xs-9 col-md-9">
      <div class="jumbotron" id="my_jumbotron">
        <h1 class="title">Rainbow Mural</h1>
        <p class="title"><!-- Explore street art around the world.<br> -->
          Street art is all around us! Explore your city, holiday destination or favorite city. <br><br></p>
        <div>
          <div class='col-xs-12 col-sm-6 col-md-3'>
            <a class="btn btn-success my_btn" id="rainbow1" href="map.php?lat=52.516&lon=13.376&place=Berlin">Berlin</a>
          </div>
          <div class='col-xs-12 col-sm-6 col-md-3'>
            <a class="btn btn-success my_btn" id="rainbow2" href="map.php?lat=51.506&lon=-0.127&place=London">London</a>
          </div>
          <div class='col-xs-12 col-sm-6 col-md-3'>
            <a class="btn btn-success my_btn" id="rainbow3" href="map.php?lat=48.856&lon=2.341&place=Paris">Paris</a>
          </div>
          <div class='col-xs-12 col-sm-6 col-md-3'>
            <a class="btn btn-success my_btn" id="rainbow4" href="map.php?lat=37.779&lon=-122.420&place=San%20Francisco">San Francisco</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-2 col-md-2"></div>
  </div>
</div>
</body>
