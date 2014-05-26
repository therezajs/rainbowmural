<?php
  require('../system/Picture.php');

$picture = new Picture();
$picture->processFormData($_POST);
