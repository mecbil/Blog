<?php
namespace Controllers ;

require_once('../application/autoload.php');

use Models\PostManager;
use application\Renderer;

class MainController
{
    // Montrer la page index avec 3 Posts
    public function showIndex()
    {
        $model= new PostManager();

        // Get all posts
        $posts = $model->findAll("", "date_modify DESC", "3");

        // Affichage (Show)
        $pageTitle = "Home" ;
        \Application\Renderer::render('index', compact('pageTitle', 'posts'));
    }

    // Montrer la page contact
    public function showContact()
    {
        $pageTitle = "Contact Us" ;
        Renderer::render('users/contact', compact('pageTitle'));
        exit();
    }

    // Montrer la page de tous les Posts trier par date'
    public function showPosts()
    {
        $model= new PostManager();

        // Get all posts
        $posts = $model->findAll("", "date_modify DESC");

        // Affichage (Show)
        $pageTitle = "Blog Posts";
        Renderer::render('posts/posts', compact('pageTitle', 'posts'));
        exit();
    }
}
