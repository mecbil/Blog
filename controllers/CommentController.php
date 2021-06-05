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
        $erreur= $comment->creat();

        // Pas d'erreur
        if (empty($erreur[1])) {

            $modelpost= new PostManager();
            $modelcomment= new CommentManager();
            $post = $modelpost->find('post_id', $post);
            $post_id = $post->post_id;
            $comments = $modelcomment->search('post_id', $post_id);

            // Affichage (Show)
            $pageTitle = "Blog Posts";
            Renderer::render('posts/post', compact('pageTitle', 'post', 'comments'));

        } else {
            $modelpost= new PostManager();
            $modelcomment= new CommentManager();
            $post = $modelpost->find('post_id', $post);
            $post_id = $post->post_id;
            $comments = $modelcomment->search('post_id', $post_id);

            // Affichage (Show)
            $pageTitle = "Blog Posts";
            $erreur = $erreur[1];
            Renderer::render('posts/post', compact('pageTitle', 'post', 'comments', 'erreur' ));

        }
    }
}
