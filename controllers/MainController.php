<?php
namespace Controllers ;

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
        $rendu = new renderer;
        $rendu->render(array(
            'page' => 'index',
            'pageTitle' => 'Home',
            'posts' => $posts
        ));
    }

    // Montrer la page contact
    public function showContact()
    {
        $rendu = new renderer;
        $rendu->render(array(
            'page' => 'users/contact',
            'pageTitle' => 'Contact Us',
            'nom' => '',
            'prenom' => '',
            'email' => '',
            'sujet' => '',
            'msg' => ''
        ));
    }

    // Montrer la page de tous les Posts trier par date'
    public function showPosts()
    {
        $postManager = new PostManager();

        // Get all posts
        $posts = $postManager->findAllPosts("date_modify DESC");

        // Affichage (Show)
        $rendu = new renderer;
        $rendu->render(array(
            'page' => 'posts/posts',
            'pageTitle' => 'Blog Posts',
            'posts' => $posts
        ));
    }

    // Montrer la page de tous les Posts trouver par une recherche'
    public function recherche()
    {
        $word = filter_input(INPUT_POST, 'surch');

        $postManager = new PostManager();
        // tester le formulaire
        // 1- Un des elements du formulaire vide
        if (empty($word)) {
            $posts = $postManager->findAllPosts("date_modify DESC");

            $rendu = new renderer;
            $rendu->render(array(
                'page' => 'posts/posts',
                'pageTitle' => 'Blog Posts',
                'posts' => $posts
            ));
        }

        // Get all posts
        $posts = $postManager->surch($word);

        if ($posts) {
            // Affichage (Show)
            $rendu = new renderer;
            $rendu->render(array(
                'page' => 'posts/posts',
                'pageTitle' => 'Blog Posts',
                'posts' => $posts
            ));
        }
        // Affichage (Show)
        $rendu = new renderer;
        $rendu->render(array(
            'page' => 'posts/posts',
            'pageTitle' => 'Blog Posts',
            'erreur' => 'Aucun enregistrement trouver',
            'posts' => $posts
        ));
    }
}
