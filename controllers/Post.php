<?php
namespace Controllers ;

use Renderer;

require_once('../application/autoload.php');

class Post
{
    public function ShowIndex()
    {
        // Montrer la page index avec 3 Posts

        $model= new \Models\Post();

        /**
         * Get all posts
         */

        $posts = $model->FindAll("date DESC", "3");

        /**
         * Affichage (Show)
         */
          
        $pageTitle = "Home" ;
        \Application\Renderer::Render('index', compact('pageTitle', 'posts'));
    }
    public function ShowPosts()
    {
        // Montrer la page de tous les Posts trier par date'

        $model= new \Models\Post();

        /**
         * Get all posts
         */

        $posts = $model->FindAll("date DESC");

        /**
         * Affichage (Show)
         */

        $pageTitle = "Blog Posts";
        \Application\Renderer::Render('posts/posts', compact('pageTitle', 'posts'));
    }
      
    public function ShowOnePost()
    {
        // Montrer la page d'un post identifier par son id'

        $model= new \Models\Post();

        /**
         * Get a post with UUid
         */
        $get= $_GET['UUid'];
        $post = $model->Find($get, "posts");
  
        /**
         * Affichage (Show)
         */

        $pageTitle = "Blog Posts";
        \Application\Renderer::Render('posts/post', compact('pageTitle', 'post'));
    }
}
