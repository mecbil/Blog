<?php
namespace Models;

use Models\Database;

abstract class Manager
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = Database::dbConnect();
    }

    // Supprime un enregistrement on ayant son uuid
    public function delete(string $uuid):void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE uuid = :uuid");
        $query->execute(['uuid' => $uuid]);
    }

    // Hydrater un enregistrement 
    public function hydrate($objet, $donnees)
    {

        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à la clé (key)
            // titre -> setTitre
            $setter = 'set' . ucfirst($key);

            // On vérifie si le setter existe
            if (method_exists($objet, $setter)) {
                // On appelle le setter
                $objet->$setter($value);
            }
        }

        return $objet;
    }    
}