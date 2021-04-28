<?php
namespace Controllers ;
require_once('../application/autoload.php');

class Post
{
    public function showindex()
    {
        // Montrer la page index avec 3 Posts

        $model= new \Models\Post();

        /**
         * Get all posts
         */

         $posts = $model->findAll("date DESC","3");

         /**
          * Affichage (Show)
          */
          
        $pageTitle = "Home" ;
        ob_start();
        require('../views/index.html.php');
        $pageContent = ob_get_clean();
        require('../views/layout.html.php');   

    }
    public function showposts()
    {
        // Montrer la page de tous les Posts trier par date

        $model= new \Models\Post();

        /**
         * Get all posts
         */

         $posts = $model->findAll("date DESC");

         /**
          * Affichage (Show)
          */
          
        
        ob_start();
        $pageTitle = "Blog Posts";
        require('../views/posts.html.php');
        $pageContent = ob_get_clean();
        require('../views/layout.html.php');   

    }

    public function showonepost()
    {
          // Montrer la page de tous les Posts trier par date

          $model= new \Models\Post();

          /**
           * Get all posts
           */
  
           $posts = $model->findAll("date DESC");
  
           /**
            * Affichage (Show)
            */
            
          
          ob_start();
          $pageTitle = "Blog Posts";
          require('../views/posts.html.php');
          $pageContent = ob_get_clean();
          require('../views/layout.html.php');  
    }



  

}