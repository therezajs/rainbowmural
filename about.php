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
      <p>This website is a place where one can enjoy and explore the street art around the world. When logged in there is a feature to like pictures and see ones own like history. Comment the pictures if you like them and wnat to share your thoughts.</p>
      </div>
      <br>
      <h3>About me</h3>
      <div class="set_size">
      <img src="avatar.png" class="img-circle">
      </div>
      <div class="about">
	    <p>Hello, I am Thereza and I am looking for a job as web developer. I started to teach myself programming this January on Codecademy and fell in love with it. I moved to San Francisco in October 2013 to attend a programming bootcamp, <a href="http://codingdojo.com/">Coding Dojo</a>, and I am now looking for an internship or full-time position.</p>

	    <p>I built this project with php, jquery and ajax. For the pictures, I userd the flickr API and I worked with the Google API to display all the maps and markers.</p>

	    <p>To learn more about me, check out my <a href="http://www.linkedin.com/in/thereza">LinkedIn</a>, <a href="https://twitter.com/therezaJS">Twitter</a> or <a href="https://github.com/bakerstreet221b">Github</a> account</p>
      </div>
    </div>
<?php require('footer.php'); ?>
