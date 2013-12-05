<?php
    require_once('Database.php');
    require('Fav.php');


$data = new Fav();
$data->processFormData($_POST);