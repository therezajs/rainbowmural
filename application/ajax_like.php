<?php
  require_once('../system/Database.php');
  require('../system/Fav.php');


$data = new Fav();
$data->processFormData($_POST);