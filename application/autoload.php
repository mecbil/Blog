<?php

spl_autoload_register(function ($className) {
    $className = str_replace("\\", "/", $className);
    $page = "../$className.php";

    require_once $page;
});
