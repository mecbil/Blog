<?php
session_start();
// echo('str_replace('.' '.','.'-'.$url.);
$path = strtolower($_SERVER['REQUEST_URI']);

// $var = explode('/',$path);
// var_dump($_SERVER);
// var_dump($_GET);

switch ($path) {
    case '/':
        require 'home.php';
        break;
    case '/blog':
        require 'blog.php';
        break;

    case '/contact':
        require "contact.php";
        break; 
    case '/administrer':
        require "connect.php";
        break; 
    case '/connexion':
        require 'user.php';
        break;
    case "/post?UUid=".$_GET['UUid']:
        require 'post.php';
        break;
    default:
        require '404.php';
        break;
}


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