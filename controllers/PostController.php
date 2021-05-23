<?php
namespace Controllers ;

require_once('../application/autoload.php');

mecbil
use Models\CommentManager;
use application\Renderer;

use Models\Comment;
use Application\Renderer;
use Models\Post;
master
use Models\PostManager;

class PostController
{
mecbil
    // Montrer la page d'un post identifier par son uuid'
    public function showOnePost()
    {
        $modelpost= new PostManager();
        $modelcomment= new CommentManager();

        // Get a post with uuid
        $get= $_GET['uuid'];
        $post = $modelpost->find('uuid', $get);
        $comments = $modelcomment->search('uuid', $get);
  

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
master
        // Affichage (Show)
        $pageTitle = "Blog Posts";
        Renderer::render('posts/post', compact('pageTitle', 'post', 'comments'));
    }

mecbil
    // Ajouter un Blog post

    public function insertPost()
    {
        $post = new PostManager();
        $erreur= $post->insert();

        if (empty($erreur)) {
            $model= new PostManager();

            // Get all posts
            $posts = $model->findAll("", "date_modify DESC");
    
            // Affichage (Show)
            $pageTitle = "Blog Posts";
            Renderer::render('posts/posts', compact('pageTitle', 'posts'));
        } else {
            if (\session_status() === PHP_SESSION_NONE) {
                session_start();
                if (isset($_SESSION['user'])) {
                    $pageTitle = $_SESSION['user'];
    
                    Renderer::Render('users/indexuser', compact('pageTitle', 'erreur'));
                }
            }
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
master
    }

    public function delettePost()
    {
        $modelpost= new PostManager();
        $modelpost->delettePost($_GET['uuid']);

        // 
        if (empty($erreur)) {
            $model= new PostManager();

            // Get all posts
            $posts = $model->findAll("", "date_modify DESC");
    
            // Affichage (Show)
            $pageTitle = "Blog Posts";
            Renderer::render('posts/posts', compact('pageTitle', 'posts'));
        } else {
            echo ('<script>alert(\"la variable est nulle\")</script>');
            $this->showOnePost();
        }


    }
}
