<?php
namespace Models;

class ContactManager extends Manager
{
    // Traiment et envoi du mail
    public function mail()
    {
        // Un des elements du mail vide
        if (empty(filter_input(INPUT_POST, 'nom')) || empty(filter_input(INPUT_POST, 'prenom'))|| empty(filter_input(INPUT_POST, 'email')) || empty(filter_input(INPUT_POST, 'sujet')) || empty(filter_input(INPUT_POST, 'msg'))) {
            return 'Veuillez remplir tous les champs';
        }
    
        // Format de mail NON valide
        if (!filter_var(filter_input(INPUT_POST, 'email'), FILTER_VALIDATE_EMAIL)) {
            return 'Veuillez saisir un Mail valide';
        }
        // Formulaire valide
        $adressemail = 'mecbil@yahoo.fr';
        $nom = filter_input(INPUT_POST, 'nom');
        $prenom = filter_input(INPUT_POST, 'prenom');
        $email = filter_input(INPUT_POST, 'email');
        $sujet = filter_input(INPUT_POST, 'sujet');
        $message = nl2br(filter_input(INPUT_POST, 'msg'));
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
    
        //ini_set('sendmail_from', 'me@domain.com');
    
        mail($adressemail, $sujet, $content, $headers);
    
        return '';
    }
}
