<?php
namespace Models;
require_once('Database.php');

abstract class Model 
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = \Models\Database::dbconnect();
    }

    public function findAll(?string $order="",?string $limit="")
    {
        $sql= "SELECT * FROM {$this->table}";
        
        if ($order)
        {
            $sql .=" ORDER BY ".$order;
        }
        if ($limit)
        {
            $sql .=" LIMIT ".$limit;
        }
        $resultats = $this->pdo->query( $sql );
        $item = $resultats->fetchAll();
        return $item;
    }

    public function find(int $id,string $table)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        $item = $query->fetch();
        return $item;
    }

    public function delete(int $id,string $table):void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}


