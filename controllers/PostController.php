<?php
namespace Controllers ;

require_once('../application/autoload.php');

use Renderer;
use Models\Post;

class PostController
{
    // Montrer la page index avec 3 Posts
    public function showIndex()
    {
        $model= new Post();

        // Get all posts
        $posts = $model->findAll("date DESC", "3");

        // Affichage (Show)
        $pageTitle = "Home" ;
        \Application\Renderer::render('index', compact('pageTitle', 'posts'));
    }

    // Montrer la page de tous les Posts trier par date'
    public function showPosts()
    {
        $model= new Post();

        // Get all posts
        $posts = $model->findAll("date DESC");

        // Affichage (Show)
        $pageTitle = "Blog Posts";
        \Application\Renderer::render('posts/posts', compact('pageTitle', 'posts'));
    }

    // Montrer la page d'un post identifier par son id'
    public function showOnePost()
    {
        $model= new Post();

        // Get a post with UUid
        $get= $_GET['UUid'];
        $post = $model->find($get, "posts");
  
        // Affichage (Show)
        $pageTitle = "Blog Posts";
        \Application\Renderer::render('posts/post', compact('pageTitle', 'post'));
    }
}
