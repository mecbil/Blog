<?php
namespace Controllers ;

require_once '../application/autoload.php';

use application\Renderer;
use Models\ContactManager;

class ContactController
{
    // Traiement de l'affichage de la page mail
    public function submitMail()
    {
        $pageTitle = "Nous contacter";
        $nom = filter_input(INPUT_POST, 'nom');
        $prenom = filter_input(INPUT_POST, 'prenom');
        $email = filter_input(INPUT_POST, 'email');
        $sujet = filter_input(INPUT_POST, 'sujet');
        $msg = filter_input(INPUT_POST, 'msg');

        $contactmanager = new ContactManager;
        $erreur= $contactmanager->mail();

        if (empty($erreur)){
            $erreur = 'Message envoyé !';

            $rendu = new renderer;
            $rendu->render('users/contact', compact('pageTitle','erreur'));
        }
        
        if ($erreur) {
            $rendu = new renderer;
            $rendu->render('users/contact', compact('pageTitle', 'erreur', 'nom', 'prenom', 'email', 'sujet', 'msg'));
        }
    }
}