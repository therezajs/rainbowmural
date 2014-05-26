<?php
session_start();
include_once("../system/Database.php");
require('../system/Login_register.php');

$login = new LoginController();
$login->processFormData($_POST);
