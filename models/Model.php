<?php
namespace Models;

use Models\Database;

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = Database::dbConnect();
    }

    public function findAll(?string $order="", ?string $limit="")
    {
        $sql= "SELECT * FROM {$this->table}";
        
        if ($order) {
            $sql .=" ORDER BY ".$order;
        }
        if ($limit) {
            $sql .=" LIMIT ".$limit;
        }
        $resultats = $this->pdo->query($sql);
        $items = $resultats->fetchAll();

        return $items;
    }

    public function find(string $UUid)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE UUid = :UUid");
        $query->execute(['UUid' => $UUid]);
        $item = $query->fetch();
        return $item;
    }

    public function search(string $sword, string $word)
    {
        $sql= "SELECT * FROM {$this->table} WHERE ".' '.$sword.' = '."'$word'";
        $query = $this->pdo->prepare($sql);
        $query->execute([$sword => $word]);
        $item = $query->fetch();
        
        return $item;
    }

    public function delete(int $uuid):void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE uuid = :uuid");
        $query->execute(['uuid' => $uuid]);
    }
    public function insert()
    {
        $sql="INSERT INTO {$this->table} SET";
        
        $query = $this->pdo->prepare();

        $query->execute(compact('val1', 'val2', 'val3'));
    }
}
