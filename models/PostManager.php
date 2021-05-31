<?php
namespace Models;

use Models\Post;

class PostManager extends Manager
{
    protected $table = "posts";

    public function insert()
    {
        // tester le formulaire
        // 1- Un des elements du mail vide
        if (empty($_POST['title']) || empty($_POST['chapo'])|| empty($_POST['content']) || empty($_POST['author'])) {
            $erreur='Veuillez remplir tous les champs';

            return $erreur;
        }

        $title = strip_tags($_POST['title']);
        $chapo = strip_tags($_POST['chapo']);
        $content = strip_tags($_POST['content']);
        $author = strip_tags($_POST['author']);
        $date_creat = date("Y-m-d h:i:s");
        $date_modify = date("Y-m-d h:i:s");
        $uuid = uniqid();
        $userid=$_SESSION['userid'];

        // On instencie le model;
        $post = new Post;       

        // Hydraté les informations reçus

        $post->setTitle($title)
            ->setChapo($chapo)
            ->setContent($content)
            ->setAuthor($author)
            ->setDate_creat($date_creat)
            ->setDate_modify($date_modify)
            ->setUuid($uuid)
            ->setUserid($userid);

        // On enregistre

        $sql = $this->pdo->prepare("INSERT INTO  posts (uuid, date_creat, date_modify, chapo, content, title, author, userid) 
        VALUES (:uuid, :date_creat, :date_modify, :chapo, :content, :title, :author, :userid)");

        $sql->bindValue(':uuid', $post->getUuid());
        $sql->bindValue(':date_creat', $post->getDate_creat());
        $sql->bindValue(':date_modify', $post->getDate_modify());
        $sql->bindValue(':chapo', $post->getChapo());
        $sql->bindValue(':content', $post->getContent());
        $sql->bindValue(':title', $post->getTitle());
        $sql->bindValue(':author', $post->getAuthor());
        $sql->bindValue(':userid', $post->getUserId());
        $sql->execute();

        $erreur = '';
            
        return $erreur;
    }

    public function deletePost($uuid)
    {
        $post = $this->find('uuid', $uuid);
        if ($post) {
            $this->delete($uuid);

            $erreur='';
            return $erreur;            
        } else {
            $erreur='Veuillez donner un identifiant valable';
            return $erreur; 
        }
    }
}