<?php
  require_once('../system/Database.php');
  require('../system/Favorite.php');


$data = new Favorite();
$data->processFormData($_POST);