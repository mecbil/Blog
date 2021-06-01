<?php
session_start();
use Application\Site;

require_once('../Application/autoload.php');

Site::frontControl();
