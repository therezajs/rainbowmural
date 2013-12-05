<?php
    require_once('Database.php');
    require('Comment.php');


$data = new Comment();
$data->processFormData($_POST);



