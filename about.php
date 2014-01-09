<?php
	session_start();
	include("Database.php");
    require('header.php');
?>

    <div class="container" id="my_container">
      <?php
        flash();
      ?>
      <div class="page-header">
      <h2>About</h2>
      </div>
      <div class="about">
      <p>Rainbow Mural is a website to explore street art around the world. We seek to make the exeptional art work that is street art available to a wider audience.
      Users are able to create their own like history and comment the pictures to share their thoughts.
      <br>
      <br>
      Rainbow Mural was launched in November 2013 by web developer Thereza Scherrer. I strive to make an easy to use website with minimal design to best showcase the street art.
      </p>
      </div>
      <br>
      <h3>About me</h3>
      <div class="set_size col-md-2">
      <img src="avatar.png" class="img-circle">
      </div>
      <div class="about col-md 10">
	    <p>Hello, I am Thereza and I am looking for a job as web developer. I started to teach myself programming this January on Codecademy and fell in love with it. I moved to San Francisco in October 2013 to attend a programming bootcamp, <a href="http://codingdojo.com/">Coding Dojo</a></p>

	    <p>I built this project with php, jquery and ajax. For the pictures, I used the flickr API and I worked with the Google API to display all the maps and markers.</p>
      <br>
	    <p>To learn more about me, check out my <a href="http://www.linkedin.com/in/thereza">LinkedIn</a>, <a href="https://twitter.com/therezaJS">Twitter</a> and <a href="https://github.com/bakerstreet221b">Github</a> account.</p>
      </div>
    </div>
<?php require('footer.php'); ?>
