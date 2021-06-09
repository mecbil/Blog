<?php
namespace Controllers ;

require_once '../application/autoload.php';

use Models\CommentManager;
use Application\Renderer;
use Models\PostManager;

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
            $post = $postManager->find('post_id', $post);
            $uuid = $post->uuid;
            $this->affiche($uuid);

        } else {
            $postManager= new PostManager();
            $commentManager= new CommentManager();
            $post = $postManager->find('post_id', $post);
            $post_id = $post->post_id;
            $comments = $commentManager->search('post_id', $post_id);

            // Affichage (Show)
            $pageTitle = "Blog Posts";
            $erreur = $erreur[1];

            $rendu = new renderer;
            $rendu->render('posts/post', compact('pageTitle', 'post', 'comments', 'erreur' ));
        }
    }

    public function deleteComment()
    {
        $get = isset($_GET['commentid']) ? filter_var($_GET['commentid'], FILTER_VALIDATE_INT) :"";
        $uuid = isset($_GET['uuid']) ? filter_var($_GET(['uuid']), FILTER_SANITIZE_STRING) :"";

        $commentManager = new CommentManager();
        $erreur = $commentManager->deletecomment($get);

        if (empty($erreur)) {
            $this->affiche($uuid);
        }
    }

    public function affiche($uuid)
    {
        $postManager= new PostManager();
        $commentManager= new CommentManager();
        $post = $postManager->find('uuid', $uuid);
        $post_id = $post->post_id;
        $comments = $commentManager->search('post_id', $post_id);

        // Affichage (Show)
        $pageTitle = "Blog Posts";

        $rendu = new renderer;
        $rendu->render('posts/post', compact('pageTitle', 'post', 'comments'));
    }
}