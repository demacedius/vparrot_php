<?php

class Commentaire {
    private $conn;
    private $table_name = "commentaire";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllValides() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE valider = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}


