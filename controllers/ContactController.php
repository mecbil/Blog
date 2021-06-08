<?php
namespace Controllers ;

require_once '../application/autoload.php';

use application\Renderer;

class ContactController
{
    // Traiement de l'affichage de la page mail
    public function submitMail()
    {
        $pageTitle = "Contact Us";
        
        $erreur= $this->mail();

        if (empty($erreur)){
            $erreur = 'Message envoyé !';

            $rendu = new renderer;
            $rendu->render('users/contact', compact('pageTitle','erreur'));
        }
        else {
            $rendu = new renderer;
            $rendu->render('users/contact', compact('pageTitle', 'erreur'));
        }
    }
    // Traiment et envoi du mail
    public function mail()
    {
        // Un des elements du mail vide
        if (empty($_POST['nom']) || empty($_POST['prenom'])|| empty($_POST['email']) || empty($_POST['sujet']) || empty($_POST['msg'])) {
            $erreur='Veuillez remplir tous les champs';

            return $erreur;
        }

        // Format de mail NON valide
        if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
            $erreur = 'Veuillez saisir un Mail valide';

            return $erreur;   
        }

        // Formulaire valide
        $adressemail = 'mecbil@yahoo.fr';
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
       	$email = htmlspecialchars($_POST['email']);
        $sujet = htmlspecialchars($_POST['sujet']);
        $message = nl2br(htmlspecialchars($_POST['msg']));
        $content = '<html><head><title> '.htmlspecialchars($sujet) .' </title></head><body>';
        $content .= '<p>' .$message .'<p>';
        $content .= '-------------------' .'<br>';
        $content .= 'De: ' .$nom .' ' .$prenom .' (' .$email .')';
        $content .= '<p>' .'Formulaire de contact envoyé depuis le site nabilmecili.fr' .'<p>';
        $content .= '</body></html>';
     
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From:' .$nom .' ' .$prenom .'  <'.$email.'>' . '\r\n';
        $headers .=	'Content-Type: text/plain; charset="iso-8859-1"';
        $headers .= '\r\nContent-Transfer-Encoding: 8bit'.'\r\n';
        $headers .=	'X-Mailer:PHP/'. phpversion().'\r\n';

        ini_set('sendmail_from', 'me@domain.com');

        mail($adressemail, $sujet, $content, $headers);

        $erreur = '';

        return $erreur;
    }
}