<?php
namespace Controllers ;

require_once '../application/autoload.php';

use Models\CommentManager;
use application\Renderer;
use Models\PostManager;
use Models\Post;

class PostController
{
    // Montrer la page d'un post identifier par son uuid'
    public function showOnePost()
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        // Get a post with uuid
        $uuid = isset($_GET['uuid']) ? filter_var($_GET['uuid'], FILTER_SANITIZE_STRING):"";
        $post = $postManager->findPost('uuid', $uuid);
        $posthydrate = new Post;
        $post = $posthydrate->hydrate($post);
        $post_id = $post->getPost_id();
        $comments = $commentManager->searchcomments('post_id', $post_id);
  
        // Affichage (Show)
        $pageTitle = "Blog Posts";

        $rendu = new renderer;
        $rendu->render('posts/post', compact('pageTitle', 'post', 'comments'));
    }

    // Ajouter un Blog post
    public function insertPost()
    {
        $postManager = new PostManager();
        $erreur= $postManager->insert();

        if (empty($erreur)) {
            
            // Get all posts
            $posts = $postManager->findAllPosts("", "date_modify DESC");
    
            // Affichage (Show)
            $pageTitle = "Blog Posts";
            
            $rendu = new renderer;
            $rendu->render('posts/posts', compact('pageTitle', 'posts'));
        } 

        if ($erreur) {

            if (isset($_SESSION['user'])) {
                $commentManager= new CommentManager();
                $comments = $commentManager->findAllcomments("", "date_modify DESC");
                $pageTitle = $_SESSION['user'];
                $edit = false;

                $rendu = new renderer;
                $rendu->render('users/indexuser', compact('pageTitle', 'erreur', 'edit', 'comments'));
            }
        }
    }

    public function deletePost()
    {
        $uuid = $_GET['uuid'];

        $postManager = new PostManager();
        $erreur = $postManager->deletePost($uuid);

        // 
        if (empty($erreur)) {

            // Get all posts
            $posts = $postManager->findAllPosts("", "date_modify DESC");
    
            // Affichage (Show)
            $pageTitle = "Blog Posts";

            $rendu = new renderer;
            $rendu->render('posts/posts', compact('pageTitle', 'posts'));
        }

        if (!empty($erreur)) {
            // echo ('<script>alert(\"Enregistrement non trouver")</script>');
        }
    }

    // Liste des posts non validé
    public function validPosts()
    {
        $commentManager= new CommentManager();

        // Get all posts
        $comments = $commentManager->findAllcomments("0", "date_modify DESC");

        // Affichage (Show)
        $edit = false;

        $rendu = new renderer;
        $rendu->render('users/indexuser', compact('comments','edit'));
    }

    // Editer un posts
    public function editPost()
    {
        $postManager= new PostManager();
        $commentManager= new CommentManager();
        $comments = $commentManager->findAllcomments("0", "date_modify DESC");

        // Get a posts with uuid
        $uuid = isset($_GET['uuid'])  ? $_GET['uuid'] :"";
        $post = $postManager->findPost("uuid", $uuid);
        $_POST['title'] = $post->getTitle();
        $_POST['chapo'] = $post->getChapo();
        $_POST['content'] = $post->getcontent();
        $_POST['author'] = $post->getAuthor();
        $_POST['post_id'] = $post->getPost_id();

        // Affichage (Show)
        $pageTitle = "Admin - ".$_SESSION['user'];
        $edit = true;

        $rendu = new renderer;
        $rendu->render('users/indexuser', compact('pageTitle', 'comments', 'edit'));
    }

    public function updatePost()
    {
        $postManager = new PostManager();
        $erreur = $postManager->updatePost($_POST['post_id']);

        if (empty($erreur)) {
        
            // Get all posts
            $posts = $postManager->findAllPosts("", "date_modify DESC");
    
            // Affichage (Show)
            $pageTitle = "Blog Posts";

            $rendu = new renderer;
            $rendu->render('posts/posts', compact('pageTitle', 'posts'));
        } 
        
        if (!empty($erreur)) {

            if (isset($_SESSION['user'])) {
                $commentManager= new CommentManager();
                $comments = $commentManager->findAllcomments("", "date_modify DESC");
                $pageTitle = $_SESSION['user'];
                $edit = true;
                
                $rendu = new renderer;
                $rendu->render('users/indexuser', compact('pageTitle', 'erreur', 'comments', 'edit' ));
            }
        }          
    }
}