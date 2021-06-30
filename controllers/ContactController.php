<?php
namespace Controllers ;

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

            $rendu = new renderer;
            $rendu->render(array('page'=>'users/contact', 'pageTitle'=>$pageTitle, 'erreur'=>'Message envoyé !', 'nom'=>'', 'prenom'=>'', 'email'=>'', 'sujet'=>'', 'msg'=>''));
        }
        
        if ($erreur) {
            $rendu = new renderer;
            $rendu->render(array('page'=>'users/contact', 'pageTitle'=>$pageTitle, 'erreur'=>$erreur, 'nom'=>$nom, 'prenom'=>$prenom, 'email'=>$email, 'sujet'=>$sujet, 'msg'=>$msg));
        }
    }
}