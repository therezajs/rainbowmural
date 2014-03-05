<?php require('header.php'); ?>
<div class='container' id='home_container'>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active bg">
      <img src="http://farm4.staticflickr.com/3082/3534028659_ca43d3f8d0.jpg" class="img-responsive my_carusel" alt="Responsive image" >
    </div>
    <div class="item bg">
      <img src="http://farm4.staticflickr.com/3275/2644956705_fdc733a479.jpg" class="img-responsive my_carusel" alt="Responsive image" >
    </div>
    <div class="item bg">
      <img src="http://farm4.staticflickr.com/3686/8756219931_43348f8ba5.jpg" class="img-responsive my_carusel" alt="Responsive image" >
    </div>
    <div class="item bg">
      <img src="http://farm1.staticflickr.com/88/263312718_725485ef9f.jpg" class="img-responsive my_carusel" alt="Responsive image" >
    </div>
    <div class="item bg">
      <img src="scribbles.jpg" class="img-responsive my_carusel" alt="Responsive image" >
    </div>
  </div>

  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="jumbotron" id="my_jumbotron">
        <h1 class="title">Rainbow Mural</h1>
        <p class="title"><!-- Explore street art around the world.<br> -->
          Street art is all around us! Explore your city, holiday destination or favorite city. <br><br></p>
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
      </div>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>
</body>
