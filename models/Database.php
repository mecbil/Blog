<?php
namespace Models;
class Database
{
    private static $instance= null;

    /**
     * Connexion à la base de données
     * 
     */
    

    public static function dbconnect()
    {
        if (self::$instance===null)
        {
            try
            {
                self::$instance = new \PDO ('mysql:host=localhost;dbname=mnblog;charset=utf8', 'root', '',
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO:: FETCH_ASSOC
            ]);
                
            }
            catch (\Exception $e)
            {
                echo'<script language="Javascript"> alert ( "'. $e->getMessage() .'" )</script>';
            }

        }
        
        return self::$instance;
    }
}

