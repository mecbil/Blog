<?php
namespace Application;

class Site{

    public static function frontcontrol(){

        //Controller par default Post

        if (empty($_GET['controller'])){
            $controlleruse='Post';
            
        }else{
            $controlleruse = ucfirst($_GET['controller']);
        }
        
        //Tache par default showindex

        if (empty($_GET['task'])){
            $task="showindex";
        } else {
            $task = $_GET['task'];
        }

        $controlleruse = "\Controllers\\" . $controlleruse;

        $controller = new $controlleruse();
        $controller->$task();

    }
        
}