<?php

class Database
{
    private static $instance= null;

    /**
     * Connexion à la base de données
     * 
     * @return PDO
     */

    public static function dbconnect(): PDO
    {
        if (self::$instance===null)
        {
            try
            {
                self::$instance = new PDO('mysql:host=localhost;dbname=mnexpressfood;charset=utf8', 'root', '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO:: FETCH_ASSOC
            ]);
                die('<script language="Javascript"> alert ( "'.'Connection effectué'.'" )</script>');
            }
            catch (Exception $e)
            {
                die('<script language="Javascript"> alert ( "'. $e->getMessage() .'" )</script>');
                // echo '<script language="Javascript"> alert ( "'. $e->getMessage() .'" )</script>';
            }

        }
        
        return self::$instance;
    }
}

