<?php
namespace Controllers ;

use Renderer;

require_once('../application/autoload.php');

class PostController
{
    public function showIndex()
    {
        // Montrer la page index avec 3 Posts

        $model= new \Models\Post();

        /**
         * Get all posts
         */

        $posts = $model->findAll("date DESC", "3");

        /**
         * Affichage (Show)
         */
          
        $pageTitle = "Home" ;
        \Application\Renderer::render('index', compact('pageTitle', 'posts'));
    }
    public function showPosts()
    {
        // Montrer la page de tous les Posts trier par date'

        $model= new \Models\Post();

        /**
         * Get all posts
         */

        $posts = $model->findAll("date DESC");

        /**
         * Affichage (Show)
         */

        $pageTitle = "Blog Posts";
        \Application\Renderer::render('posts/posts', compact('pageTitle', 'posts'));
    }
      
    public function showOnePost()
    {
        // Montrer la page d'un post identifier par son id'

        $model= new \Models\Post();

        /**
         * Get a post with UUid
         */
        $get= $_GET['UUid'];
        $post = $model->find($get, "posts");
  
        /**
         * Affichage (Show)
         */

        $pageTitle = "Blog Posts";
        \Application\Renderer::render('posts/post', compact('pageTitle', 'post'));
    }
}
