<?php
	session_start();
	// include("../system/Database.php");
  require('header.php');
?>

    <div class="container" id="my_container">
      <?php
        flash();
      ?>
      <div class="page-header">
      <h2>About Rainbow Mural</h2>
      </div>
      <div class="about">
      <p>Rainbow Mural is a website to explore street art around the world.
      We seek to make the exeptional art work that is street art available to a wider audience.
      Users can like their favorite photos and engage in conversations with other users.
      <br>
      <br>
      All the street art photos are scraped from Flickr. Every single one of these photos contains a geo tag with a latitude and longitude, indicating where it was taken.
      This geo tag is then used to group the photos by location and display them on a map.
      MySQL Databases are used to store users, likes of photos and comments.
      <br>
      <br>
      Rainbow Mural was launched in November 2013 by web developer Thereza Scherrer. I strive to make an easy to use website with minimal design to best showcase the street art.
      </p>
      </div>
      <br>
      <h3>About me</h3>
      <div class="set_size col-md-2">
      <img src="../assets/images/avatar.png" class="img-circle">
      </div>
      <div class="about col-md 10">
      <p>Hello, I am Thereza and I am looking for a job as web developer.
        I started to teach myself programming on Codecademy and fell in love with it.
        I moved to San Francisco in October 2013 to attend a programming bootcamp, <a href="http://codingdojo.com/">Coding Dojo</a>.</p>

      <p>I built this project with PHP, jQuery and MySQL.
        For the pictures, I used the flickr API and I worked with the Google API to display all the maps.</p>
      <br>
      <p>To learn more about me, check out my <button class="btn btn-success"><a href="http://www.linkedin.com/in/thereza">LinkedIn</a></button>, <button class="btn btn-success"><a href="https://twitter.com/therezaJS">Twitter</a></button> and <button class="btn btn-success"><a href="https://github.com/therezajs">Github</a></button> account.</p>
      </div>
    </div>
<?php require('footer.php'); ?>
