<?php
namespace Controllers ;

require_once('../application/autoload.php');

use Models\CommentManager;
use Application\Renderer;

class CommentController
{
    // Ajouter un commentair
    public function insertComment()
    {
        $comment = new CommentManager();
        $erreur= $comment->creat();

        // Pas d'erreur
        if (empty($erreur)) {
            // $pageTitle = 'Post';

            $redirect = new MainController;
            $redirect->showPosts();
        } else {
            // $pageTitle = "jhgjhg";
            $redirect = new MainController;

            $redirect->showPosts();
        }
    }
}
