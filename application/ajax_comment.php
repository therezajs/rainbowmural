<?php
  require_once('../system/Database.php');
  require('../system/Comment.php');


$data = new Comment();
$data->processFormData($_POST);



