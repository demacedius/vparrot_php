<?php

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        require 'connect.php'; // Inclure le fichier de connexion
        $this->pdo = $dbh; // Utiliser l'objet PDO défini dans connect.php
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
?>
