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
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        // Get a post with uuid
        $guuid = filter_input(INPUT_GET, 'uuid');
        $uuid = isset($guuid) ? filter_var($guuid, FILTER_SANITIZE_STRING):"";
        $post = $postManager->findPost('uuid', $uuid);
        $post_id = $post->getPost_id();
        $comments = $commentManager->searchcomments('post_id', $post_id);
  
        // Affichage (Show)
        $pageTitle = "Blog Posts";
        if (isset($_SESSION['user'])) {
            $user = filter_var($_SESSION['user']);
            $role = filter_var($_SESSION['role']);
            $user_id = filter_var($_SESSION['user_id']);
        } else {
            $user = '';
            $role = '';
            $user_id = '';
        }

        $rendu = new renderer;
        $rendu->render('posts/post', compact('pageTitle', 'post', 'comments', 'user', 'role', 'user_id'));
    }

    // Ajouter un Blog post
    public function insertPost()
    {
        $commentManager= new CommentManager();
        $comments = $commentManager->findAllcomments("date_modify DESC");
        $postManager = new PostManager();
        $erreur= $postManager->insert();

        if (empty($erreur)) {
    
            // Affichage (Show)
            $pageTitle = "Blog Posts";
            $edit = false;
            $title = '';
            $chapo = '';
            $content = '';
            $author = '';
            $post_id = '';
            $rendu = new renderer;
            $rendu->render('users/indexuser', compact('pageTitle', 'comments', 'edit', 'erreur', 'title', 'chapo', 'content', 'author', 'post_id' ));
        } 

        $pageTitle = $_SESSION['user'];
        $edit = false;
        $title = filter_input(INPUT_POST, 'title');
        $chapo = filter_input(INPUT_POST, 'chapo');
        $content = filter_input(INPUT_POST, 'content');
        $author = filter_input(INPUT_POST, 'author');
        $post_id = filter_input(INPUT_POST, 'post_id');

        $rendu = new renderer;
        $rendu->render('users/indexuser', compact('pageTitle', 'comments', 'edit', 'erreur', 'title', 'chapo', 'content', 'author', 'post_id' ));

    }

    public function deletePost()
    {
        $uuid = filter_input(INPUT_GET, 'uuid');

        $postManager = new PostManager();
        $erreur = $postManager->deletePost($uuid);

        // Pas d'erreur de suppression
        if (empty($erreur)) {

            // Get all posts
            $posts = $postManager->findAllPosts("date_modify DESC");
    
            // Affichage (Show)
            $pageTitle = "Blog Posts";

            $rendu = new renderer;
            $rendu->render('posts/posts', compact('pageTitle', 'posts'));
        }
    }

    // Liste des posts non validé
    public function validPosts()
    {
        $commentManager= new CommentManager();

        // Get all posts
        $comments = $commentManager->findAllcomments("date_modify DESC");

        // Affichage (Show)
        $edit = false;
        $title = '';
        $chapo = '';
        $content = '';
        $author = '';
        $post_id = '';

        $rendu = new renderer;
        $rendu->render('users/indexuser', compact('comments', 'edit','title', 'chapo', 'content', 'author', 'post_id' ));
    }

    // Editer un posts
    public function editPost()
    {
        $postManager= new PostManager();
        $commentManager= new CommentManager();
        $comments = $commentManager->findAllcomments("date_modify DESC");

        // Get a posts with uuid
        $guuid = filter_input(INPUT_GET, 'uuid');
        $uuid = isset($guuid)  ? $guuid :"";
        $post = $postManager->findPost("uuid", $uuid);

        // Affichage (Show)
        $pageTitle = "Admin - ".$_SESSION['user'];
        $edit = true;

        $rendu = new renderer;
        $rendu->render('users/indexuser', compact('pageTitle', 'comments', 'edit', 'post'));
    }

    public function updatePost()
    {
        $gpost = filter_input(INPUT_POST, 'post_id');
        
        $postManager = new PostManager();
        $erreur = $postManager->updatePost($gpost);

        if (empty($erreur)) {
        
            // Get all posts
            $posts = $postManager->findAllPosts("date_modify DESC");
    
            // Affichage (Show)
            $pageTitle = "Blog Posts";

            $rendu = new renderer;
            $rendu->render('posts/posts', compact('pageTitle', 'posts'));
        } 
        
        if (!empty($erreur)) {

            if (isset($_SESSION['user'])) {
                $commentManager= new CommentManager();
                $comments = $commentManager->findAllcomments("date_modify DESC");
                $pageTitle = $_SESSION['user'];
                $edit = true;
                
                $rendu = new renderer;
                $rendu->render('users/indexuser', compact('pageTitle', 'erreur', 'comments', 'edit' ));
            }
        }          
    }
}