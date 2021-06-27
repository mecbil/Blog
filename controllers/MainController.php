<?php
namespace Controllers ;

// require_once '../application/autoload.php';

use Models\PostManager;
use application\Renderer;

class MainController
{
    // Montrer la page index avec 3 Posts
    public function showIndex()
    {
        // Get all posts
        $postManager= new PostManager();
        $posts = $postManager->findAllposts("date_modify DESC", "3");

        // Affichage (Show)
        $pageTitle = "Home" ;
        $rendu = new renderer;
        $rendu->render('index', array('pageTitle'=>$pageTitle, 'posts'=>$posts));
    }

    // Montrer la page contact
    public function showContact()
    {
        $rendu = new renderer;
        $rendu->render('users/contact', array('pageTitle'=>'Contact Us', 'nom'=>'','prenom'=>'', 'email'=>'', 'sujet'=>'', 'msg'=>''));
    }

    // Montrer la page de tous les Posts trier par date'
    public function showPosts()
    {
        $postManager = new PostManager();

        // Get all posts
        $posts = $postManager->findAllPosts("date_modify DESC");

        // Affichage (Show)
        $pageTitle = "Blog Posts";
        $rendu = new renderer;
        $rendu->render('posts/posts', array('pageTitle'=>$pageTitle, 'posts'=>$posts));
    }
}