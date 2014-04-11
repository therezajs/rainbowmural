<?php
	session_start();
	include("../system/Database.php");
    require('header.php');
?>

<div class="container" id="my_container">
  <?php
    flash();
  ?>
  <h2>Upload Pictures</h2>

  <p class="upload">Rainbow Mural displays pictures from flickr. To have your pictures displayed on this website, please follow these steps:</p>
  <br>
  <ol class="upload">
    <li>Go to http://www.flickr.com/ and if necessary create a new account</li>
    <li>Proceed to http://www.flickr.com/photos/upload/ and upload your picture/s</li>
    <li>Tag the pictures with one or more of the following tags:</li>
      <ul>
        <li>Mural</li>
        <li>Street Art</li>
        <li>Graffiti</li>
        <li>Urban Art</li>
        <li>Wall Art</li>
      </ul>
    <li>That's it. Your all done.</li>
  </ol>
</div>

<?php require('footer.php'); ?>
