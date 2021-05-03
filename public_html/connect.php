<?php
session_start();
// session_unset();
// session_destroy();
require_once('../Application/autoload.php');

$controller = new \controllers\User();

$controller->connect();