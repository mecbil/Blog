<?php
if (\session_status() === PHP_SESSION_NONE) {
    session_start();
}

use Application\Site;

require_once '../Application/autoload.php';

Site::frontControl();