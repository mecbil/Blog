<?php
namespace Controllers ;

require_once('../application/autoload.php');

use Models\Comment;
use Application\Renderer;
use Models\Post;
use Models\PostManager;

class PostController
{
    // Montrer la page index avec 3 Posts
    public function showIndex()
    {
        $model= new PostManager();

        // Get all posts
        $posts = $model->findAll("date_modify DESC", "3");

        // Affichage (Show)
        $pageTitle = "Home" ;
        \Application\Renderer::render('index', compact('pageTitle', 'posts'));
    }

    // Montrer la page de tous les Posts trier par date'
    public function showPosts()
    {
        $model= new PostManager();

        // Get all posts
        $posts = $model->findAll("date_modify");

        // Affichage (Show)
        $pageTitle = "Blog Posts";
        \Application\Renderer::render('posts/posts', compact('pageTitle', 'posts'));
    }

    // Montrer la page d'un post identifier par son id'
    public function showOnePost()
    {
        $modelpost= new Post();
        $modelcomment= new Comment();

        // Get a post with UUid
        $get= $_GET['UUid'];
        $post = $modelpost->find('UUID',$get);
        $comments = $modelcomment->search('UUID',$get);
  
        // Affichage (Show)
        $pageTitle = "Blog Posts";
        \Application\Renderer::render('posts/post', compact('pageTitle', 'post', 'comments'));
    }
}
