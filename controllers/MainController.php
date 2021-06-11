<?php
namespace Controllers ;

require_once '../application/autoload.php';

use Models\PostManager;
use application\Renderer;

class MainController
{
    // Montrer la page index avec 3 Posts
    public function showIndex()
    {
        $postManager= new PostManager();

        // Get all posts
        $posts = $postManager->findAllposts("", "date_modify DESC", "3");

        // Affichage (Show)
        $pageTitle = "Home" ;
        $rendu = new renderer;
        $rendu->render('index', compact('pageTitle', 'posts'));
    }

    // Montrer la page contact
    public function showContact()
    {
        $pageTitle = "Contact Us" ;
        $rendu = new renderer;
        $rendu->render('users/contact', compact('pageTitle'));
    }

    // Montrer la page de tous les Posts trier par date'
    public function showPosts()
    {
        $postManager = new PostManager();

        // Get all posts
        $posts = $postManager->findAllPosts("", "date_modify DESC");

        // Affichage (Show)
        $pageTitle = "Blog Posts";
        $rendu = new renderer;
        $rendu->render('posts/posts', compact('pageTitle', 'posts'));
    }
}