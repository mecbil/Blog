<?php
namespace Controllers ;

require_once '../application/autoload.php';

use Models\CommentManager;
use Application\Renderer;
use Models\PostManager;

class CommentController
{
    // Ajouter un commentaire
    public function insertComment()
    {
        $post = filter_input(INPUT_POST, 'post_id');
        $postManager= new PostManager();
        $commentManager = new CommentManager();
        $erreur = $commentManager->creat();

        // Pas d'erreur
        if (empty($erreur[1])) {
            $post = $postManager->findPost('post_id', $post);
            $uuid = $post->getUuid();
            $this->affiche($uuid, 'Votre commentaire sera afficher après validation!');

        } else {
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
        $commentManager = new CommentManager();

        $gget = filter_input(INPUT_GET, 'commentid');
        $guuid = filter_input(INPUT_GET, 'uuid');

        $get = isset($gget) ? filter_var($gget, FILTER_VALIDATE_INT) :"";
        $uuid = isset($guuid) ? filter_var($guuid, FILTER_SANITIZE_STRING):"";
  
        $erreur = $commentManager->deletecomment($get);

        if (empty($erreur)) {
            $this->affiche($uuid, 'Commentaire supprimer avec succès!');
        }      
    }

    public function valideComment()
    {
        $guuid = filter_input(INPUT_GET, 'uuid');
        $uuid = isset($guuid) ? filter_var($guuid, FILTER_SANITIZE_STRING):"";
        $commentManager = new CommentManager();
        $erreur = $commentManager->valideComment($uuid);

        if (empty($erreur)) {
            $UserController = new UserController;
            $UserController->showConnect();
            return;
        } 
        
        // if ($erreur) {

        // }          
    }

    public function affiche($uuid, $erreur)
    {
        $postManager= new PostManager();
        $commentManager= new CommentManager();
        $post = $postManager->findPost('uuid', $uuid);
        $post_id = $post->getPost_id();

        $comments = $commentManager->searchcomments('post_id', $post_id);

        // Affichage (Show)
        $pageTitle = "Blog Posts";

        $rendu = new renderer;
        $rendu->render('posts/post', compact('pageTitle', 'post', 'comments', 'erreur'));
    }
}