<?php
$path=$_SERVER['REQUEST_URI'];

require '../views/header.html.php';
switch ($path) {
    case '/':
        require 'home.php';
        break;
    case '/Blog':
        require 'blog.php';
        break;
    case '/Blog/[*:titre]-[i:id]':
        require 'post.php';
        break;
    case '/Contact':
        require 'Contact.php';
        break; 
    case '/Connection':
        require 'user.php';
        break;  
    default:
        require '404.php';
        break;
}
require '../views/footer.html.php';