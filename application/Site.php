<?php
namespace Application;

class Site
{
    public static function FrontControl()
    {

        //Controller par default Post

        if (empty($_GET['Controller'])) {
            $controlleruse='Post';
        } else {
            $controlleruse = ucfirst($_GET['Controller']);
        }
        
        //Tache par default showindex

        if (empty($_GET['task'])) {
            $task="ShowIndex";
        } else {
            $task = $_GET['task'];
        }

        $controlleruse = "\Controllers\\" . $controlleruse;

        $controller = new $controlleruse();
        $controller->$task();
    }
}
