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
        $comment = new CommentManager();
        $erreur = $comment->creat();

        // Pas d'erreur
        if (empty($erreur[1])) {

            $modelpost= new PostManager();
            $post = $modelpost->find('post_id', $post);
            $uuid = $post->uuid;
            $this->affiche($uuid);

        } else {
            $modelpost= new PostManager();
            $modelcomment= new CommentManager();
            $post = $modelpost->find('post_id', $post);
            $post_id = $post->post_id;
            $comments = $modelcomment->search('post_id', $post_id);

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

        $modelcomment = new CommentManager();
        $erreur = $modelcomment->deletecomment($get);

        if (empty($erreur)) {
            $this->affiche($uuid);
        }
    }

    public function affiche($uuid)
    {
        $modelpost= new PostManager();
        $modelcomment= new CommentManager();
        $post = $modelpost->find('uuid', $uuid);
        $post_id = $post->post_id;
        $comments = $modelcomment->search('post_id', $post_id);

        // Affichage (Show)
        $pageTitle = "Blog Posts";

        $rendu = new renderer;
        $rendu->render('posts/post', compact('pageTitle', 'post', 'comments'));
    }
}
