<?php
// echo('str_replace('.' '.','.'-'.$url.);
$path=$_SERVER['REQUEST_URI'];
$var=explode('/',$path);

require '../views/header.html.php';
switch ($path) {
    case '/':
        require 'home.php';
        break;
    case '/Blog':
        require 'blog.php';
        break;
    case "/post":
        require 'post.php';
        break;
    case '/Contact':
        require "Contact.php";
        break; 
    case '/Connexion':
        require 'user.php';
        break;  
    default:
        require '404.php';
        break;
}
require '../views/footer.html.php';

// define ('ROOT', str_replace('\public_html\index.php','',$_SERVER['SCRIPT_FILENAME']));

// $params= explode('/', $_GET['p']);

// require_once('../views/header.html.php');

// if (empty($params[0]))
// {
//     require_once('home.php');  
// }

// if (!empty($params[0]))
// {
//     $controller = ucfirst($params[0]);
//     var_dump($controller);

//     $task = isset($params[1]) ? $params[1] : 'home';

//     require(ROOT.'\controllers\\'.$controller.'.php');

//     $controller = new $controller();

//     if(method_exists($controller,$task))
//     {
//         var_dump($task);
//         $controller -> $task;
//     }else
//     {
//         echo"erreur 404";
//     }
    
// }else
// {
//    require_once('home.php');
// }
// require_once('../views/footer.html.php');