<?php
class Voiture
{
    private $conn;
    private $table_name = "voiture";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllVoitures($tri)
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY " . $tri;
        $stmt = $this->conn->query($query);

        $voitures = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $voitures[] = $row;
        }

        return $voitures;
    }
}
