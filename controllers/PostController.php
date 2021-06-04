<?php
namespace Controllers ;

require_once '../application/autoload.php';

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
                $modelcomment= new CommentManager();
                $comments = $modelcomment->findAll("", "date_modify DESC");
                $pageTitle = $_SESSION['user'];
                $edit = false;

                Renderer::Render('users/indexuser', compact('pageTitle', 'erreur', 'edit', 'comments'));
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
        $model= new commentManager();

        // Get all posts
        $comments = $model->findAll("0", "date_modify DESC");

        // Affichage (Show)
        $edit = false;

        Renderer::render('users/indexuser', compact('comments','edit'));
    }

        // Editer un posts
        public function editPost()
        {
            $model= new PostManager();
            $modelcomment= new CommentManager();
            $comments = $modelcomment->findAll("0", "date_modify DESC");
    
            // Get a posts with uuid
            $get= $_GET['uuid'];
            $post = $model->find("uuid", $get);
            $_POST['title'] = $post->title;
            $_POST['chapo'] = $post->chapo;
            $_POST['content'] = $post->content;
            $_POST['author'] = $post->author;
            $_POST['id'] = $post->id;
    
            // Affichage (Show)
            $pageTitle = "Admin - ".$_SESSION['user'];
            $edit = true;

            Renderer::render('users/indexuser', compact('pageTitle', 'comments', 'edit'));
        }

        public function updatePost()
        {
            $modelpost = new PostManager();
            $erreur = $modelpost->updatePost($_POST['id']);

            if (empty($erreur)) {
            
                // Get all posts
                $posts = $modelpost->findAll("", "date_modify DESC");
        
                // Affichage (Show)
                $pageTitle = "Blog Posts";
                Renderer::render('posts/posts', compact('pageTitle', 'posts'));
            } 
            
            if (!empty($erreur)) {
    
                if (isset($_SESSION['user'])) {
                    $modelcomment= new CommentManager();
                    $comments = $modelcomment->findAll("", "date_modify DESC");
                    $pageTitle = $_SESSION['user'];
                    $edit = true;
    
                    Renderer::Render('users/indexuser', compact('pageTitle', 'erreur', 'comments', 'edit' ));
                }
            }
            
        }
}