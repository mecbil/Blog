<?php
namespace Controllers ;

require_once '../application/autoload.php';

use Models\CommentManager;
use Application\Renderer;
use Models\PostManager;
use Models\Post;

class CommentController
{
    // Ajouter un commentair
    public function insertComment()
    {
        $post = $_POST['post_id'];
        $commentManager = new CommentManager();
        $erreur = $commentManager->creat();

        // Pas d'erreur
        if (empty($erreur[1])) {

            $postManager= new PostManager();
            $post = $postManager->findPost('post_id', $post);
            $uuid = $post->getUuid();
            $this->affiche($uuid);

        } else {
            $postManager= new PostManager();
            $commentManager= new CommentManager();
            $post = $postManager->findPost('post_id', $post);
            $post_id = $post->getpost_id();
            $comments = $commentManager->searchcomments('post_id', $post_id);

            // Affichage (Show)
            $pageTitle = "Blog Posts";
            $erreur = $erreur[1];

            $rendu = new renderer;
            $rendu->render('posts/post', compact('pageTitle', 'post', 'comments', 'erreur' ));
        }
    }

    public function deleteComment()
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $get = isset($_GET['commentid']) ? filter_var($_GET['commentid'], FILTER_VALIDATE_INT) :"";
        $uuid = isset($_GET['uuid']) ? filter_var($_GET['uuid'], FILTER_SANITIZE_STRING):"";
  
        $erreur = $commentManager->deletecomment($get);

        if (empty($erreur)) {
            $this->affiche($uuid);
        }      
    }

    public function valideComment()
    {
        $uuid = isset($_GET['uuid']) ? filter_var($_GET['uuid'], FILTER_SANITIZE_STRING):"";
        $commentManager = new CommentManager();
        $erreur = $commentManager->valideComment($uuid);

        if (empty($erreur)) {
        $UserController = new UserController;
        $UserController->showConnect();
        } 
        
        if (!empty($erreur)) {

        }          
    }

    public function affiche($uuid)
    {
        $postManager= new PostManager();
        $commentManager= new CommentManager();
        $post = $postManager->findPost('uuid', $uuid);
        $post_id = $post->getPost_id();

        $comments = $commentManager->searchcomments('post_id', $post_id);

        // Affichage (Show)
        $pageTitle = "Blog Posts";

        $rendu = new renderer;
        $rendu->render('posts/post', compact('pageTitle', 'post', 'comments'));
    }
}