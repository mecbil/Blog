<?php
namespace Controllers ;

require_once('../application/autoload.php');

use Models\CommentManager;
use application\Renderer;
use Models\PostManager;

class PostController
{
    // Montrer la page d'un post identifier par son uuid'
    public function showOnePost()
    {
        $modelpost= new PostManager();
        $modelcomment= new CommentManager();

        // Get a post with uuid
        $get= $_GET['uuid'];
        $post = $modelpost->find('uuid', $get);
        $postid = $post->id;
        $comments = $modelcomment->search('post_id', $postid);
  
        // Affichage (Show)
        $pageTitle = "Blog Posts";
        Renderer::render('posts/post', compact('pageTitle', 'post', 'comments'));
    }

    // Ajouter un Blog post
    public function insertPost()
    {
        $post = new PostManager();
        $erreur= $post->insert();

        if (empty($erreur)) {
            
            // Get all posts
            $posts = $post->findAll("", "date_modify DESC");
    
            // Affichage (Show)
            $pageTitle = "Blog Posts";
            Renderer::render('posts/posts', compact('pageTitle', 'posts'));
        } else {

            if (isset($_SESSION['user'])) {
                $pageTitle = $_SESSION['user'];

                Renderer::Render('users/indexuser', compact('pageTitle', 'erreur'));
            }
        }
    }

    public function deletePost()
    {
        $modelpost = new PostManager();
        $modelpost->deletePost($_GET['uuid']);

        // 
        if (empty($erreur)) {
            $model= new PostManager();

            // Get all posts
            $posts = $model->findAll("", "date_modify DESC");
    
            // Affichage (Show)
            $pageTitle = "Blog Posts";
            Renderer::render('posts/posts', compact('pageTitle', 'posts'));
        } else {
            echo ('<script>alert(\"Enregistrement non trouver")</script>');
            $this->showOnePost();
        }
    }

    // Liste des posts non validé

    public function validPosts()
    {
        $model= new PostManager();

        // Get all posts
        $comments = $model->findAll("0", "date_modify DESC");

        // Affichage (Show)

        Renderer::render('users/indexuser', compact('comments'));
    }
}