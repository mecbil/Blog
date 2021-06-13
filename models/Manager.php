<?php
namespace Models;

use Models\Database;
use Models\Post;
use Models\Comment;


abstract class Manager
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = Database::dbConnect();
    }

    // Rechercher des enregistrement
    public function search(string $sword, string $word)
    {
        $sql= "SELECT * FROM {$this->table} WHERE ".' '.$sword.' = '."'$word'";
        $query = $this->pdo->prepare($sql);
        $query->execute([$sword => $word]);
        $item = $query->fetchAll();
        
        return $item;
    }

    // Supprime un enregistrement on ayant son uuid
    public function delete(string $uuid):void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE uuid = :uuid");
        $query->execute(['uuid' => $uuid]);
    }

    // Hydrater un enregistrement 
    public function hydrate($donnees)
    {
        foreach ($donnees as $key => $value)
        {
            foreach ($donnees as $key => $value) {
                // On récupère le nom du setter correspondant à la clé (key)
                // titre -> setTitre
                $setter = 'set' . ucfirst($key);
    
                // On vérifie si le setter existe
                if (method_exists($this, $setter)) {
                    // On appelle le setter
                    $this->$setter($value);
                }
            }
            return $this;
        }
    }    
}