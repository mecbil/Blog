<?php
namespace Models;

abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = \Models\Database::DbConnect();
    }

    public function FindAll(?string $order="", ?string $limit="")
    {
        $sql= "SELECT * FROM {$this->table}";
        
        if ($order) {
            $sql .=" ORDER BY ".$order;
        }
        if ($limit) {
            $sql .=" LIMIT ".$limit;
        }
        $resultats = $this->pdo->query($sql);
        $item = $resultats->fetchAll();
        return $item;
    }

    public function Find(string $UUid)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE UUid = :UUid");
        $query->execute(['UUid' => $UUid]);
        $item = $query->fetch();
        return $item;
    }

    public function Search(string $sword, string $word)
    {
        $sql= "SELECT * FROM {$this->table} WHERE ".' '.$sword.' = '."'$word'";
        $query = $this->pdo->prepare($sql);
        $query->execute([$sword => $word]);
        $item = $query->fetch();
        
        return $item;
    }

    public function Delete(int $uuid):void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE uuid = :uuid");
        $query->execute(['uuid' => $uuid]);
    }
    public function Insert()
    {
        $sql="INSERT INTO {$this->table} SET";
        
        $query = $this->pdo->prepare();

        $query->execute(compact('val1', 'val2', 'val3'));
    }
}
